<?php
namespace Germania\Hash;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Turns PHP's password_verify function into a callable with logging capability.
 */
class PasswordVerifyCallable
{


    /**
     * @var LoggerInterface
     */
    public $logger;


    /**
     * @param LoggerInterface $logger Optional: PSR-3 Logger
     */
    public function __construct( LoggerInterface $logger = null )
    {
        $this->logger = $logger ?: new NullLogger;
    }


    /**
     * @param  string $password        Password to test
     * @param  string $hashed_password Password hash
     * @return boolean
     */
    public function __invoke( $password, $hashed_password )
    {
        $result = password_verify( $password, $hashed_password);
        $this->logger->debug( "Veryfing password", [
            'result' => $result ? "TRUE" : "FALSE"
        ]);
        return $result;
    }
}
