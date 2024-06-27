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

    /**
     * Menjalankan Validasi
     * ● Setelah kita membuat Validator, selanjutnya yang biasa kita lakukan adalah mengecek apakah
     *   validasi sukses atau gagal
     * ● Untuk melakukan itu, kita bisa menggunakan dua method yang mengembalikan nilai boolean
     * ● fails(), akan mengembalikan true jika gagal, false jika sukses
     * ● passes(), akan mengembalikan true jika sukses, false jika gagal
     *
     * note:
     * fails() // Tentukan apakah data gagal dalam aturan validasi...
     * passes() // Tentukan apakah data lolos aturan validasi...
     */

    public function testValidatorSuccess(){

        $data = [
            "username" => "admin",
            "password" => "rahasia",
        ];

        $rules = [
            "username" => "required",
            "password" => "required",
        ];

        $validator = Validator::make($data, $rules); // Illuminate/Support/Facades/Validator // package validation untuk laravel

        self::assertFalse($validator->fails()); // fails() // true jika gagal, false jika sukses
        self::assertTrue($validator->passes()); // passes() // true jika sukses, false jika gagal

        var_dump($validator->fails()); // bool(false)
        var_dump($validator->passes()); // bool(true)

    }

    public function testValidatorFailed(){

        $data = [
            "username" => "",
            "password" => "",
        ];

        $rules = [
            "username" => "required",
            "password" => "required",
        ];

        $validator = Validator::make($data, $rules); // Illuminate/Support/Facades/Validator // package validation untuk laravel

        self::assertTrue($validator->fails()); // fails() // true jika gagal, false jika sukses
        self::assertFalse($validator->passes()); // passes() // true jika sukses, false jika gagal

        var_dump($validator->fails()); // bool(true)
        var_dump($validator->passes()); // bool(false)

    }

}
