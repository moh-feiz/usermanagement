<?php


class LoginOtpTest extends TestCase
{
    public function testLoginOtp()
    {
        $this->post('/api/v1/user/registersite', [
            "username" => "09123456789",
            "email" => "moh@gmail.com",
            "password" => "1234",
        ]);

        $this->seeJsonStructure([
            "error",
            "username",
            "message",
        ]);
    }
}
