<?php


class ProfileTest extends TestCase
{
    public function testProfile()
    {
        $this->post('/api/v1/user/site-register', [
            "username" => "09123456789",
        ]);

        $this->seeJsonStructure([
            "error",
            "username",
            "message",
        ]);
    }
}
