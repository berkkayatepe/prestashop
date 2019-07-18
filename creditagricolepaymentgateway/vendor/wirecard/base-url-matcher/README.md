# wirecard/base-url-matcher

[![License](https://img.shields.io/badge/license-GPLv3-blue.svg)](https://github.com/wirecard/base-url-matcher/blob/master/LICENSE)
[![PHP v5.6](https://img.shields.io/badge/php-v5.6-yellow.svg)](http://www.php.net)
[![PHP v7.0](https://img.shields.io/badge/php-v7.0-yellow.svg)](http://www.php.net)
[![PHP v7.1](https://img.shields.io/badge/php-v7.1-yellow.svg)](http://www.php.net)
[![PHP v7.2](https://img.shields.io/badge/php-v7.2-yellow.svg)](http://www.php.net)
[![PHP v7.3](https://img.shields.io/badge/php-v7.3-yellow.svg)](http://www.php.net)
[![Build status](https://api.travis-ci.org/wirecard/base-url-matcher.svg?branch=master)](https://travis-ci.org/wirecard/base-url-matcher)

***
## General information 
This is a library for syncing Base URL with WPP URL
***

## Installation

The library can be installed using [Composer](https://getcomposer.org/download/).  
If you have not installed Composer, you can follow the [offical instructions](https://getcomposer.org/doc/00-intro.md).

Once composer is installed, run this in your terminal/command-line tool:

`composer require wirecard/base-url-matcher`

## Usage

In your application load the `vendor/autoload.php` that Composer provides.   
You can then initialize the `BaseUrlMatcherService` class like so:

```php
use Wirecard\BaseUrlMatcher\BaseUrlMatcherService;
$wppUrl = BaseUrlMatcherService::getWppUrl('https://api.wirecard.com');
```


If you have any questions or need further assistance do not hesitate to contact our [support teams](mailto:support.at@wirecard.com ).
