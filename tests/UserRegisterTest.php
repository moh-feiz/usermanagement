<?php


class UserRegisterTest extends TestCase
{
    public function testUserRegister()
    {
        $this->post('/api/v1/user/site-register', [
            "username" => "09123456789",
            "email" => "moh@gmail.com",
            "password" => "123456",
        ]);

        $this->seeJsonStructure([
            "error",
            "username",
            "message",
        ]);
    }
}
