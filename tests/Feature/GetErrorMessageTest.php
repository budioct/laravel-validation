<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class GetErrorMessageTest extends TestCase
{
    /**
     * Error Message
     * ● Saat kita melakukan validasi, kita perlu tahu key mana yang bermasalah, dan apa pesan error nya
     * ● Kita bisa mendapatkan detail dari error menggunakan function messages(), errors(), atau
     *   getMessageBag(), yang semuanya akan mengembalikan object sama yaitu class MessageBag
     * ● https://laravel.com/api/10.x/Illuminate/Support/MessageBag.html
     */

    public function testValidatorGetErrorMessage(){

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

        self::assertTrue($validator->fails()); // fails() // true jika gagal, false jika sukses

        // Illuminate\Support\MessageBag // MessageBag package implement pesan error validation
        $message = $validator->getMessageBag(); // getMessageBag() // Get pesan error validation.
        Log::error($message->toJson(JSON_PRETTY_PRINT));

        // keys(): array // ambil semua keys rules dan apa yang di berikan pesan errornya
        foreach ($message->keys() as $key => $value) {
            echo "\t Key  : {$key}";
            echo "\tValue: {$value}";
        }

        // get(key): array // ambil pesan error berdasarkan key rules
        $error_username = $message->get("username");
        $error_password = $message->get("password");
        echo "\nMessage: {$error_username[0]}\n"; // Message: The username field is required.
        echo "Message: {$error_password[0]}\n"; // Message: The password field is required.

        /**
         * result:
         * [2024-06-28 02:38:36] testing.ERROR: {
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
