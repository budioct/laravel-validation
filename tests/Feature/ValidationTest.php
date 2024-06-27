<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class ValidationTest extends TestCase
{
    /**
     * Validator
     * ● Validator adalah class sebagai representasi untuk melakukan validasi di Laravel
     * ● https://laravel.com/api/10.x/Illuminate/Validation/Validator.html
     * ● Ada banyak sekali fitur yang dimiliki oleh class Validator, dan kita akan bahas secara bertahap
     *
     * Membuat Validator
     * ● Untuk membuat Validator, kita bisa menggunakan static method di Facade Validator::make()
     * ● https://laravel.com/api/10.x/Illuminate/Support/Facades/Validator.html
     * ● Saat membuat Validator, kita harus tentukan data yang akan divalidasi, dan rules (aturan-aturan validasi)
     */

    public function testMembuatValidator(){

        $data = [
            "username" => "admin",
            "password" => "rahasia",
        ];

        $rules = [
            "username" => "required",
            "password" => "required",
        ];

        $validator = Validator::make($data, $rules); // Illuminate/Support/Facades/Validator // package validation untuk laravel
        self::assertNotNull($validator);

    }

}
