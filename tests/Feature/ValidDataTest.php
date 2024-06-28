<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class ValidDataTest extends TestCase
{
    /**
     * Valid Data
     * ● Laravel Validator bisa mengembalikan data yang berisikan hanya attribute yang di validasi
     * ● Hal ini sangat cocok ketika kita memang tidak ingin menggunakan attribute yang tidak di validasi
     * ● Untuk mendapatkan data tersebut, kita bisa menggunakan return value validated()
     */

    public function testValidatorValidDataSuccess(){

        $data = [
            "username" => "budhi@test.com",
            "password" => "rahasiabro",
            "admin" => true, // tidak ada rules validasi.. tidak akan di return
            "others" => "xxx" // tidak ada rules validasi.. tidak akan di return
        ];

        $rules = [
            "username" => ["required", "email", "max:100"],
            "password" => ["required", "min:6", "max:20"],
        ];

        // Illuminate\Support\Facades\Validator; // Validator package implement validation untuk laravel
        $validator = Validator::make($data, $rules); // make(array $data, array $rules) // method yang check validasi
        self::assertNotNull($validator);
        self::assertTrue($validator->passes());

        try {

            //$valid = $validator->validated(); // validated() // dapatkan atribut dan nilai yang telah divalidasi.
            $valid = $validator->validate(); // validate() // jalankan aturan validator terhadap datanya.
            Log::info(json_encode($valid, JSON_PRETTY_PRINT));

        } catch (ValidationException $exception) {

            self::assertNotNull($exception->validator); // validator // instance ValidationException.
            $message = $exception->validator->errors(); // errors(): MessageBag // dapatkan pesan error validation.
            Log::error($message->toJson(JSON_PRETTY_PRINT));
        }

        /**
         * result: hasil validasi yang sesuai rules akan return attribute/field dan value, yang tidak ada rules tidak akan di return
         * [2024-06-28 03:36:27] testing.INFO: {
         * "username": "budhi@test.com",
         * "password": "rahasiabro"
         * }
         */
    }

    public function testValidatorValidDataInvalid(){

        $data = [
            "username" => "",
            "password" => "",
            "admin" => true, // tidak ada rules validasi.. tidak akan di return
            "others" => "xxx" // tidak ada rules validasi.. tidak akan di return
        ];

        $rules = [
            "username" => ["required", "email", "max:100"],
            "password" => ["required", "min:6", "max:20"],
        ];

        // Illuminate\Support\Facades\Validator; // Validator package implement validation untuk laravel
        $validator = Validator::make($data, $rules); // make(array $data, array $rules) // method yang check validasi
        self::assertNotNull($validator);
        self::assertTrue($validator->fails());

        try {

            //$valid = $validator->validated(); // validated() // dapatkan atribut dan nilai yang telah divalidasi.
            $valid = $validator->validate(); // validate() // jalankan aturan validator terhadap datanya.
            Log::info(json_encode($valid, JSON_PRETTY_PRINT));

        } catch (ValidationException $exception) {

            self::assertNotNull($exception->validator); // validator // instance ValidationException
            $message = $exception->validator->errors(); // errors(): MessageBag // dapatkan pesan error validation.
            Log::error($message->toJson(JSON_PRETTY_PRINT));
        }

        /**
         * result:
         * [2024-06-28 03:41:33] testing.ERROR: {
         * "username": [
         * "The username field is required."
         * ],
         * "password": [
         * "The password field is required."
         * ]
         * }
         */
    }

}
