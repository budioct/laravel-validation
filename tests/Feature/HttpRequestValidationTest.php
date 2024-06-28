<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HttpRequestValidationTest extends TestCase
{
    /**
     * HTTP Request Validation
     * ● Laravel Validator sudah terintegrasi dengan baik dengan HTTP Request di Laravel
     * ● Class Request memiliki method validate() untuk melakukan validasi data request yang dikirim oleh
     *   User, misal dari Form atau Query Parameter
     * ● https://laravel.com/api/10.x/Illuminate/Http/Request.html#method_validate
     *
     * // buat controller
     * // buat route
     * // testing pada unit test
     */

    public function testLoginFailed(): void
    {

        $responseQueryParam = $this->post("/form/login?username=&password");

        $responseFormInput = $this->post("/form/login", [
            "username" => "",
            "password" => "",
        ]);

        $responseQueryParam->assertStatus(400);
        $responseFormInput->assertStatus(400);

    }

    public function testLoginSuccess(): void
    {

        $responseQueryParam = $this->post("/form/login?username=budhi&password=budhi");

        $responseFormInput = $this->post("/form/login", [
            "username" => "budhi",
            "password" => "budhi",
        ]);

        $responseQueryParam->assertStatus(200);
        $responseFormInput->assertStatus(200);

    }

}
