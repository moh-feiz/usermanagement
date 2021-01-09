<?php


class SetFormerPassengersTest extends TestCase
{
    public function testget()
    {
        $this->post('/api/v1/formerpsg/set', [
            "username" => "09123456782",
            "passengers" => [
                ['passenger_id' => '', "first_name_fa" => 'محسن', "last_name_fa" => 'فیض',
                    "first_name_en" => 'moh', "last_name_en" => 'feiz',
                    'social_code' => "0453397646", 'gender' => 20,
                    'birthday' => '1990-11-05', 'mobile' => '',
                    'passport_number' => 'a123', 'country_passport' => 1,
                    'expire_date_passport' => '2023-11-05'],
],
        ]);

        $this->seeJsonStructure([
            "update",
            "set",
        ]);
    }
}
