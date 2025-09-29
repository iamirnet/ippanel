<?php

namespace iAmirNet\IPPanel;

use iAmirNet\Curl\iCurl;

class Rest
{
    public $api_key, $username, $password, $order, $lang = 'fa';
    public $base_url = "https://edge.ippanel.com/v1/api/";

    public function __construct($username, $password = null)
    {
        if ($username && $password) {
            $this->username = $username;
            $this->password = $password;
        }else $this->api_key = $username;
    }

    public static function init($username, $password = null)
    {
        return new static($username, $password);
    }

    public function request($endpoint, $params = [], $data = null, $method = "GET", $headers = [], $options = [])
    {
        $options[CURLOPT_USERAGENT] = "iAmirNet/IPPanel-PHP-SDK";
        $response = iCurl::request($this->base_url, $endpoint, $params, $data, array_merge([
            "Authorization" => $this->api_key,
            "Content-Type" => "application/json"
        ], $headers), $method, $options);
        if (@$response['status']) {
            if (@$response["response"]["meta"]["status"] === true)
                return [
                    "status" => true,
                    "message" => @$response["response"]["meta"]["message"]?:"درخواست موفق بود.",
                    "data" => @$response["response"]["data"]?:[],
                ];
            else
                return [
                    "status" => false,
                    "message" => @$response["response"]["meta"]["message"]?:"درخواست ناموفق بود.",
                    "errors" => @$response["response"]["meta"]["errors"]?:[]
                ];
        }else
            return ['status' => false, 'message' => $response['message']];
    }

    public function send($type, $data = [], $from = null)
    {
        $data = array_merge([
            "sending_type" => $type,
        ], $data);
        if ($type !== "votp" && empty($data["from_number"]))
            $data["from_number"] = $from?:"+983000505";
        $result = $this->request("send", [], $data, "POST");
        if ($result['status'])
            $result["ids"] = @$result["data"]["message_outbox_ids"]?:[];
        return $result;
    }

    public function pattern($recipients, $code, $params = [], $from = null)
    {
        return $this->send("pattern", [
            "code" => $code,
            "recipients" => is_array($recipients) ? $recipients : [$recipients],
            "params" => $params
        ], $from);
    }

    public function web($recipients, $message, $send_time = null, $from = null, $params = null)
    {
        $data = [
            "message" => $message,
            "params" => array_merge([
                "recipients" => is_array($recipients) ? $recipients : [$recipients],
            ], $params?:[])
        ];
        if ($send_time)
            $data["send_time"] = $send_time;

        return $this->send("webservice", $data, $from);
    }

    public function p2p($params, $send_time = null, $from = null)
    {
        $data = ["params" => $params];
        if ($send_time)
            $data["send_time"] = $send_time;
        return $this->send("peer_to_peer", $data, $from);
    }

    public function votp($recipients, $code, $params = [])
    {
        return $this->send("votp", [
            "message" => $code,
            "params" => array_merge([
                "recipients" => is_array($recipients) ? $recipients : [$recipients],
            ], $params?:[])
        ], null);
    }

    public function message($id)
    {
        return $this->request("report/by_bulk", ["messages_outbox_id" => $id]);
    }
}
