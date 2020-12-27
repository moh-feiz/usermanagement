<?php


class VerificationTest extends TestCase
{
    public function testVerification()
    {

        $this->post('/api/mobile-verification', [
           "verifycode" => "1234",
            "mobile" => "09123456789",
        ]);

        $this->seeJsonStructure([
            "error",
            "message",
            "mobile",
        ]);
    }
}
