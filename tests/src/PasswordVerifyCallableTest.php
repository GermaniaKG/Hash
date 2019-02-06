<?php
namespace tests;

use Germania\Hash\PasswordVerifyCallable;

class PasswordVerifyCallableTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider provideSomeSecrets
     */
    public function testIfWorksDefault( $token, $algo )
    {
        $token_hash = password_hash($token, $algo);

        $sut = new PasswordVerifyCallable;
        $result = $sut( $token, $token_hash );
        $this->assertTrue( $result );
    }


    /**
     * @dataProvider provideSomeSecrets
     */
    public function testIfFalseOnWrong( $token, $algo )
    {
        $token_hash = password_hash($token, $algo);

        $sut = new PasswordVerifyCallable;
        $result = $sut( "SomethingElse", $token_hash );
        $this->assertFalse( $result );
    }



    public function provideSomeSecrets()
    {
        return array(
            [ "foo", \PASSWORD_BCRYPT  ],
            [ "bar", \PASSWORD_DEFAULT ]
        );
    }

}
