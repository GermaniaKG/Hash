<?php
namespace tests;

use Germania\Hash\CallbackHashCallable;

class CallbackHashCallableTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider provideSomeSecrets
     */
    public function testIfWorksSimple( $token )
    {
        $callback = function( $token ) { return $token; } ;

        $sut = new CallbackHashCallable( $callback );

        $result = $sut( $token );
        $this->assertInternalType( "string", $result );
        $this->assertEquals( $token, $result );
    }


    /**
     * @dataProvider provideSomeSecrets
     */
    public function testIfWorksSHA1( $token )
    {
        $callback = function( $token ) { return sha1($token); } ;

        $sut = new CallbackHashCallable( $callback );

        $result = $sut( $token );
        $this->assertInternalType( "string", $result );
        $this->assertEquals( sha1($token), $result );
    }


    public function provideSomeSecrets()
    {
        return array(
            [ "foo" ],
            [ "bar" ]
        );
    }

}
