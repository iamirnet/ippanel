<?php

require '../vendor/autoload.php';

$service = \iAmirNet\IPPanel\Rest::init("apikey");

var_dump($service->pattern("+989123456789", "ddjvnyi2c7", ["code" => 123456]));
var_dump($service->votp("+989123456789", "123456"));
var_dump($service->web("+989123456789", "code: 123456\niamir.net.net"));
die();