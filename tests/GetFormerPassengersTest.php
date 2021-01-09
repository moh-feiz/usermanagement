<?php


class GetFormerPassengersTest extends TestCase
{
    public function testget()
    {
        $this->post('/api/v1/formerpsg/get', [
            "username" => "09123456782",
        ]);

        $this->seeJsonStructure([
            "error",
            "message",
            "former_passengers"
        ]);
    }
}
