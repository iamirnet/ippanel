[![Latest Version](https://img.shields.io/github/release/iamirnet/ippanel.svg?style=flat-square)](https://github.com/iamirnet/ippanel/releases)
[![GitHub last commit](https://img.shields.io/github/last-commit/iamirnet/ippanel.svg?style=flat-square)](#)
[![Packagist Downloads](https://img.shields.io/packagist/dt/iamirnet/ippanel.svg?style=flat-square)](https://packagist.org/packages/iamirnet/ippanel)

# PHP IPPanel Webservice
This project is designed to help you make your own projects that interact with the IPPanel

#### Installation
```
composer require iamirnet/ippanel
```
<details>
 <summary>Click for help with installation</summary>

## Install Composer
If the above step didn't work, install composer and try again.
#### Debian / Ubuntu
```
sudo apt-get install curl php-curl
curl -s http://getcomposer.org/installer | php
php composer.phar install
```
Composer not found? Use this command instead:
```
php composer.phar require "iamirnet/ippanel"
```

#### Installing on Windows
Download and install composer:
1. https://getcomposer.org/download/
2. Create a folder on your drive like C:\iAmirNet\IPPanel
3. Run command prompt and type `cd C:\iAmirNet\IPPanel`
4. ```composer require iamirnet/ippanel```
5. Once complete copy the vendor folder into your project.

</details>

#### Getting started
`composer require iamirnet/ippanel`
```php
require 'vendor/autoload.php';
// config by specifying api key and secret
$api = new \iAmirNet\IPPanel\Rest("apikey");
```


=======

=======
#### Send Message
```php
//Call this before running any functions
print_r($api->send(/*Receive Number*/"989xxxxxxxxxx",/*Text Message*/ "متن پیامک", /*Sender Number*/"989999xxxx",));
```

## Contribution
- Give us a star :star:
- Fork and Clone! Awesome
- Select existing [issues](https://github.com/iamirnet/ippanel/issues) or create a [new issue](https://github.com/iamirnet/ippanel/issues/new) and give us a PR with your bugfix or improvement after. We love it ❤️

## Donate
- USDT Or TRX: TUE8GiY4vmz831N65McwzZVbA9XEDaLinn 😘❤
