<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\In;
use Illuminate\Validation\Rules\Password;
use Tests\TestCase;

class RuleClassTest extends TestCase
{
    /**
     * Rule Class
     * ● Selain Rule-Rule yang kita lihat di halaman dokumentasi Laravel
     * ● Laravel juga menyediakan beberapa class Rule yang bisa kita gunakan ketika membuat Validator
     * ● Kita bisa lihat daftar class-class Rule yang tersedia di package Rules
     * ● https://laravel.com/api/10.x/Illuminate/Validation/Rules.html
     */

    public function testValidationRuleClassInvalid(){

        $data = [
            "username" => "budhi@test.com",
            "password" => "budhi@test.com",
        ];

        // di sarankan membuat multiple rules denga Array
        // auturan validasi sekarang menggunakan class..
        // class In([data]) --> validasi akan true jika data sesuai dalam data array
        // static class Password --> bisa memberikan validation pipline,
        // min(6) minimal 6 karakter,
        // letters() harus ada huruf,
        // numbers() harus ada nomer,
        // symbols() harus ada symbol
        $rules = [
            "username" => ["required", new In(["Budhi", "Jamal", "Malik"])],
            "password" => ["required", Password::min(6)->letters()->numbers()->symbols()],
        ];

        // Illuminate\Support\Facades\Validator; // Validator package implement validation untuk laravel
        $validator = Validator::make($data, $rules); // make(array $data, array $rules) // method yang check validasi
        self::assertNotNull($validator);

        self::assertFalse($validator->passes()); // passes() // true jika sukses, false jika gagal
        self::assertTrue($validator->fails()); // fails() // true jika gagal, false jika sukses

        // Illuminate\Support\MessageBag // MessageBag package implement pesan error validation
        $message = $validator->getMessageBag(); // getMessageBag():MessageBag // Get pesan error validation.

        Log::error($message->toJson(JSON_PRETTY_PRINT));

        /**
         * result:
         * [2024-06-28 08:07:11] testing.ERROR: {
         * "username": [
         * "The selected username is invalid."
         * ],
         * "password": [
         * "The password must contain at least one number."
         * ]
         * }
         */
    }

    public function testValidationRuleClassSuccess(){

        $data = [
            "username" => "Budhi",
            "password" => "budhi43@test.com",
        ];

        // di sarankan membuat multiple rules denga Array
        // auturan validasi sekarang menggunakan class..
        // class In([data]) --> validasi akan true jika data sesuai dalam data array
        // static class Password --> bisa memberikan validation pipline,
        // min(6) minimal 6 karakter,
        // letters() harus ada huruf,
        // numbers() harus ada nomer,
        // symbols() harus ada symbol
        $rules = [
            "username" => ["required", new In(["Budhi", "Jamal", "Malik"])],
            "password" => ["required", Password::min(6)->letters()->numbers()->symbols()],
        ];

        // Illuminate\Support\Facades\Validator; // Validator package implement validation untuk laravel
        $validator = Validator::make($data, $rules); // make(array $data, array $rules) // method yang check validasi
        self::assertNotNull($validator);

        self::assertTrue($validator->passes()); // passes() // true jika sukses, false jika gagal
        self::assertFalse($validator->fails()); // fails() // true jika gagal, false jika sukses

        // Illuminate\Support\MessageBag // MessageBag package implement pesan error validation
        $message = $validator->getMessageBag(); // getMessageBag():MessageBag // Get pesan error validation.

        Log::error($message->toJson(JSON_PRETTY_PRINT));

        /**
         * result:
         * [2024-06-28 08:09:57] testing.ERROR: []
         */
    }

}
