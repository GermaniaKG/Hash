<?php
namespace tests;

use Germania\Hash\CallbackHashCallable;

class CallbackHashCallableTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider provideSomeSecrets
     */
    public function testIfWorksSimple( $token ) : void
    {
        $callback = function( $token ) { return $token; } ;

        $sut = new CallbackHashCallable( $callback );

        $result = $sut( $token );
        $this->assertIsString( $result );
        $this->assertEquals( $token, $result );
    }


    /**
     * @dataProvider provideSomeSecrets
     */
    public function testIfWorksSHA1( $token ) : void
    {
        $callback = function( $token ) { return sha1($token); } ;

        $sut = new CallbackHashCallable( $callback );

        $result = $sut( $token );
        $this->assertIsString( $result );
        $this->assertEquals( sha1($token), $result );
    }


    public function provideSomeSecrets() : array
    {
        return array(
            [ "foo" ],
            [ "bar" ]
        );
    }

}
