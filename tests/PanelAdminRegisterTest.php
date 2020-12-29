<?php


class PanelAdminRegisterTest extends TestCase
{
    public function testPanelAdminRegister()
    {
        $this->post('/api/v1/user/panel-register', [
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
