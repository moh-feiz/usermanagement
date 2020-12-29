<?php


class UserSafeDeleteTest extends TestCase
{
    public function testUserSafeDelete()
    {
        $this->post('/api/v1/user/delete', [
            "username" => "09123456789",
        ]);

        $this->seeJsonStructure([
            "error",
            "username",
            "message",
        ]);
    }
}
