<?php


class LoginUserNameTest extends TestCase
{
    public function testLoginUserName()
    {
        $this->post('/api/v1/login', [
            "type" => "username",
            "username" => "moh@gmail.com",
            "password" => "moh",
        ]);

        $this->seeJsonStructure([
            "error",
            "message",
            "username",
        ]);
    }
}

