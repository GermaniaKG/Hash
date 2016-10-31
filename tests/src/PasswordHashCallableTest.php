<?php
namespace tests;

use Germania\Hash\PasswordHashCallable;

class PasswordHashCallableTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider provideSomeSecrets
     */
    public function testIfWorksDefault( $token )
    {
        $sut = new PasswordHashCallable;

        $result = $sut( $token );
        $this->assertInternalType( "string", $result );
        $this->assertTrue( password_verify( $token, $result) );
    }


    /**
     * @dataProvider provideSomeSecretsWithCost
     */
    public function testIfWorksWithCustomCost( $token, $cost )
    {
        PasswordHashCallable::$cost = $cost;
        $sut = new PasswordHashCallable;

        $result = $sut( $token );
        $this->assertInternalType( "string", $result );
        $this->assertTrue( password_verify( $token, $result) );
    }

    public function provideSomeSecrets()
    {
        return array(
            [ "foo"],
            [ "bar" ]
        );
    }

    public function provideSomeSecretsWithCost()
    {
        return array(
            [ "foo", 6 ],
            [ "bar", 10 ]
        );
    }
}
