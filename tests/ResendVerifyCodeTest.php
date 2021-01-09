<?php


class ResendVerifyCodeTest extends TestCase
{
    public function testResendVerifyCode()
    {
        $this->post('/api/v1/login/resend-verify-code', [
          "mobile" => "09123456789",
        ]);

        $this->seeJsonStructure([
            "error",
            "message",
            "mobile",
        ]);
    }
}
