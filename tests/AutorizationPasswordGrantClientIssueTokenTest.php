<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AutorizationPasswordGrantClientIssueTokenTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIssueToken()
    {
        $this->post('/oauth/token' , [
            "password"=>"moh",
            "username"=>"moh@gmail.com",
            "grant_type"=>"password",
            "client_id"=>4,
            "client_secret"=>"TUENrZgcCu2GK5dCfxdY1wXJ69llGi82WnpPd8e1",
        ]);

        $this->seeJsonStructure([
            "token_type",
            "expires_in",
            "access_token",
            "refresh_token",
        ]);
    }
}
