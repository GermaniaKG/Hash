<?php
namespace Germania\Hash;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;


class CallbackHashCallable
{

    /**
     * @var LoggerInterface
     */
    public $logger;

    /**
     * @var Callable
     */
    public $callback;



    /**
     * @param Callable        $callback Callable or anonymous function
     * @param LoggerInterface $logger   Optional: PSR-3 Logger
     */
    public function __construct( Callable $callback, LoggerInterface $logger = null )
    {
        $this->callback = $callback;
        $this->logger   = $logger ?: new NullLogger;
    }

    /**
     * @param  string $token Your secret
     * @return string Hashed secret
     */
    public function __invoke( $token )
    {
        $this->logger->debug( "Calling callback for token" );

        $callback = $this->callback;
        return $callback($token );
    }
}
