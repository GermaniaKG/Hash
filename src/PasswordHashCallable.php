<?php
namespace Germania\Hash;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Turns PHP's password_hash function into a callable with logging capability.
 */
class PasswordHashCallable
{


    /**
     * @var int
     */
    public static $cost = 14;


    /**
     * @var int
     */
    public static $algo = \PASSWORD_BCRYPT;


    /**
     * @var LoggerInterface
     */
    public $logger;


    /**
     * @param LoggerInterface $logger Optional: PSR-3 Logger
     */
    public function __construct( LoggerInterface $logger = null )
    {
        $this->logger   = $logger ?: new NullLogger;
    }


    /**
     * @param  string $token Your secret
     * @return string Hashed secret
     */
    public function __invoke( $token )
    {
        $this->logger->debug( "Hashing token", [
            'algo' => static::$algo,
            'cost' => static::$cost
        ]);

        return password_hash( $token, static::$algo, [
            'cost' => static::$cost
        ]);
    }
}
