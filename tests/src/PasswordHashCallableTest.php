<?php
namespace tests;

use Germania\Hash\PasswordHashCallable;

class PasswordHashCallableTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider provideSomeSecrets
     */
    public function testIfWorksDefault( $token ) : void
    {
        $sut = new PasswordHashCallable;

        $result = $sut( $token );
        $this->assertIsString( $result );
        $this->assertTrue( password_verify( $token, $result) );
    }


    /**
     * @dataProvider provideSomeSecretsWithCost
     */
    public function testIfWorksWithCustomCost( $token, $cost ) : void
    {
        PasswordHashCallable::$cost = $cost;
        $sut = new PasswordHashCallable;

        $result = $sut( $token );
        $this->assertIsString( $result );
        $this->assertTrue( password_verify( $token, $result) );
    }

    public function provideSomeSecrets() : array
    {
        return array(
            [ "foo"],
            [ "bar" ]
        );
    }

    public function provideSomeSecretsWithCost() : array
    {
        return array(
            [ "foo", 6 ],
            [ "bar", 10 ]
        );
    }
}
