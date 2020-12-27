<?php


class LoginOtpTest extends TestCase
{
    public function testLoginOtp()
    {
        $this->post('/api/v1/login', [
            "type" => "otp",
            "mobile" => "09123456789",
        ]);

        $this->seeJsonStructure([
            "error",
            "message",
            "mobile",
        ]);
    }
}
