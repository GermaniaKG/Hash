#Hash Callables

[![Build Status](https://travis-ci.org/GermaniaKG/Hash.svg?branch=master)](https://travis-ci.org/GermaniaKG/Hash?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/GermaniaKG/Hash/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Hash/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/GermaniaKG/Hash/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Hash/?branch=master)

##Installation

```bash
$ composer require germania-kg/hash
```


##PasswordHashCallable

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

###Configuration

You optionally may define *cost* and *algo* parameters for PHP's [password_hash](http://php.net/manual/de/function.password-hash.php) function. They default to `14` and `\PASSWORD_BCRYPT` respectively.

```php
<?php
use Germania\Hash\PasswordHashCallable;

// Defaults
PasswordHashCallable::$cost = 14;
PasswordHashCallable::$algo = \PASSWORD_BCRYPT;
```

##PasswordVerifyCallable


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



##CallbackHashCallable

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



##Development and testing

Clone repo, use [Git Flow](https://github.com/nvie/gitflow). Work on *develop* branch.

```bash
# Clone Repo
$ git clone git@github.com:GermaniaKG/Hash.git germania-hash
$ cd germania-hash
$ composer install
```

For testing, copy PHPUnit configuration file and customize if needed.

```bash
$ cp phpunit.xml.dist phpunit.xml
$ phpunit
```
