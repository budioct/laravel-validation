<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class AdditionalValidationTest extends TestCase
{
    /**
     * Additional Validation
     * ● Saat kita selesai melakukan validasi, kadang kita ingin melakukan validasi tambahan
     * ● Pada kasus seperti ini, kita bisa menggunakan method after(callback), dimana kita bisa
     *   menambahkan function callback sebagai parameter
     * ● Function callback nya terdapat satu parameter yaitu Validator, sehingga kita bisa menambah error tambahan jika dibutuhkan
     */

    public function testAdditionalValidation(){

        $data = [
            "username" => "budhi@test.com",
            "password" => "budhi@test.com",
        ];

        // di sarankan membuat multiple rules denga Array
        // auturan validasi
        $rules = [
            "username" => ["required", "email", "max:100"], // rules email sudah kita custom
            "password" => ["required", "min:6", "max:20"],
        ];

        // Illuminate\Support\Facades\Validator; // Validator package implement validation untuk laravel
        $validator = Validator::make($data, $rules); // make(array $data, array $rules) // method yang check validasi

        // after(callback) // untuk kasus validasi tambahan
        // \Illuminate\Validation\Validator $doubleCheck // parameter return Validator sehingga kita bisa menambah error tambahan jika dibutuhkan
        $validator->after(function (\Illuminate\Validation\Validator $doubleCheck){

            $data = $doubleCheck->getData(); // getData():array // Dapatkan data dalam validasi.

            // check jika data attribute username dan password sama maka tambahkan pesan error validasi
            if ($data["username"] == $data["password"]) {
                $doubleCheck->errors()->add("password", "Password tidak boleh sama dengan Username"); // add("key_attribute", "pesan_validasi") // add pesan validasi
            }
        });

        self::assertNotNull($validator);
        self::assertTrue($validator->fails());

        $message = $validator->getMessageBag();

        Log::info($message->toJson(JSON_PRETTY_PRINT));

        /**
         * [2024-06-28 04:36:40] testing.INFO: {
         * "password": [
         * "Password tidak boleh sama dengan Username"
         * ]
         * }
         */
    }
}
