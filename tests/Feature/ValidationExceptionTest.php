<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class ValidationExceptionTest extends TestCase
{
    /**
     * Validation Exception
     * ● Pada beberapa kasus, kadang-kadang kita ingin menggunakan Exception ketika melakukan validasi
     * ● Jika data tidak valid, maka harapan kita terjadi exception
     * ● Validator juga menyediakan fitur ini, dengan menggunakan method validated()
     * ● Saat kita memanggil method validated(), jika data tidak valid, maka akan throw ValidationException
     * ● Untuk mendapatkan detail informasi validator dan error message, bisa kita ambil dari ValidationException
     * ● https://laravel.com/api/10.x/Illuminate/Validation/ValidationException.html
     */

    public function testValidatorValidationException(){

        $data = [
            "username" => "",
            "password" => "",
        ];

        $rules = [
            "username" => "required",
            "password" => "required",
        ];

        // Illuminate\Support\Facades\Validator; // Validator package implement validation untuk laravel
        $validator = Validator::make($data, $rules); // make(array $data, array $rules) // method yang check validasi

        try {
            $validator->validated(); // validate() // jalankan aturan validator terhadap datanya.
            //$validator->validated(); // validated() // dapatkan atribut dan nilai yang telah divalidasi.
            self::fail("ValidationException not thrown");
        } catch (ValidationException $exception){

            self::assertNotNull($exception->validator); // validator // instance ValidationException
            $message = $exception->validator->errors(); // errors(): MessageBag // dapatkan pesan error validation.
            Log::error($message->toJson(JSON_PRETTY_PRINT));
        }

        /**
         * result:
         * [2024-06-28 03:00:43] testing.ERROR: {
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
