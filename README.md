# Germania KG • Hash Callables

**Callable wrapper around PHP's password hashing and verification, optional with PSR3 Logger support**

[![Packagist](https://img.shields.io/packagist/v/germania-kg/hash.svg?style=flat)](https://packagist.org/packages/germania-kg/hash)
[![PHP version](https://img.shields.io/packagist/php-v/germania-kg/hash.svg)](https://packagist.org/packages/germania-kg/hash)
[![Build Status](https://img.shields.io/travis/GermaniaKG/Hash.svg?label=Travis%20CI)](https://travis-ci.org/GermaniaKG/Hash)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/GermaniaKG/Hash/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Hash/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/GermaniaKG/Hash/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Hash/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/GermaniaKG/Hash/badges/build.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Hash/build-status/master)



## Installation with Composer

```bash
$ composer require germania-kg/hash
```

## PasswordHashCallable

This class wraps PHP's [password_hash](http://php.net/manual/de/function.password-hash.php) function in a callable class. It optionally accepts any PSR-3 Logger of which the *debug* method will be called each time it is invoked.

```php
<?php
use Germania\Hash\PasswordHashCallable;

// Create Callable, optional with PSR-3 Logger
$hashing = new PasswordHashCallable;
$hashing = new PasswordHashCallable( $monolog );

// Get hashed value
echo $hashing( "mysecret" );
```

### Configuration

You optionally may define *cost* and *algo* parameters for PHP's [password_hash](http://php.net/manual/de/function.password-hash.php) function. They default to `14` and `\PASSWORD_BCRYPT` respectively.

```php
<?php
use Germania\Hash\PasswordHashCallable;

// Defaults
PasswordHashCallable::$cost = 14;
PasswordHashCallable::$algo = \PASSWORD_BCRYPT;
```

## PasswordVerifyCallable


This class wraps PHP's [password_verify](http://php.net/manual/de/function.password-verify.php) function in a callable class. It optionally accepts any PSR-3 Logger of which the *debug* method will be called each time it is invoked.

```php
<?php
use Germania\Hash\PasswordVerifyCallable;

// Create Callable, optional with PSR-3 Logger
$verifier = new PasswordVerifyCallable;
$verifier = new PasswordVerifyCallable( $monolog );

// Get hashed value
$secret = "foobar";
$hash   = password_hash($secret, \PASSWORD_BCRYPT);
$hash   = password_hash($secret, \PASSWORD_DEFAULT)

// Will be TRUE
echo $verifier( "foobar", $hash );

// Will be FALSE
echo $verifier( "wrong", $hash );
```



## CallbackHashCallable

This class requires a custom callback (Callable or anonymous function). 
It optionally accepts any PSR-3 Logger of which the *debug* method will be called each time it is invoked.

```php
<?php
use Germania\Hash\CallbackHashCallable;

// Create anonymous function
$callback = function( $token ) {
	return password_hash( $token );
};

// Create Callable, optional with PSR-3 Logger
$hashing = new CallbackHashCallable( $callback );
$hashing = new CallbackHashCallable( $callback, $monolog );

// Get hashed value
echo $hashing( "mysecret" );
```

## Issues

See [issues list.][i0]

[i0]: https://github.com/GermaniaKG/Hash/issues 


## Development

```bash
$ git clone https://github.com/GermaniaKG/Hash.git
$ cd Hash
$ composer install
```

## Unit tests

Either copy `phpunit.xml.dist` to `phpunit.xml` and adapt to your needs, or leave as is. Run [PhpUnit](https://phpunit.de/) test or composer scripts like this:

```bash
$ composer test
# or
$ vendor/bin/phpunit
```

