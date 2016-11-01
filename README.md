#Hash Callables


##Installation

```bash
$ composer require germania-kg/hash
```


##PasswordHashCallable

This class wraps PHP's [password_hash](http://php.net/manual/de/function.password-hash.php) function in a callable Class. It optionally accepts any PSR-3 Logger of which the *debug* method will be called each time it is invoked.

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
