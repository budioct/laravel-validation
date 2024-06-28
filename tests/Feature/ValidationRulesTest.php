<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class ValidationRulesTest extends TestCase
{
    /**
     * Validation Rules
     * ● Salah satu keuntungan menggunakan Laravel Validator, yaitu sudah disediakan aturan-aturan yang
     *   bisa kita gunakan untuk melakukan validasi
     * ● Kita bisa lihat di halaman dokumentasi untuk melihat detail dari aturan-aturan yang sudah disediakan di Laravel untuk validasi
     * ● https://laravel.com/docs/10.x/validation#available-validation-rules
     * ● Bagaimana jika aturan yang kita butuhkan tidak ada? Kita juga bisa membuat aturan sendiri, yang
     *   akan dibahas di materi terpisah
     *
     * Multiple Rules
     * ● Saat kita membuat validasi, biasanya dalam satu attribute, kita sering menggunakan beberapa aturan
     * ● Misal untuk username, kita ingin menggunakan aturan wajib diisi, harus email, dan panjang tidak
     *   boleh lebih dari 100 karakter
     * ● Untuk menggunakan multiple Rules, kita bisa menggunakan tanda | (pagar), atau menggunakan
     *   tipe data array
     */

    public function testValidatorMultipleRulesInvalid(){

        $data = [
            "username" => "",
            "password" => "test",
        ];

        // di sarankan membuat multiple rules denga Array
        $rules = [
            "username" => "required|email|max:100",
            "password" => ["required", "min:6", "max:20"],
        ];

        // Illuminate\Support\Facades\Validator; // Validator package implement validation untuk laravel
        $validator = Validator::make($data, $rules); // make(array $data, array $rules) // method yang check validasi
        self::assertNotNull($validator);

        self::assertTrue($validator->fails()); // fails() // true jika gagal, false jika sukses
        self::assertFalse($validator->passes()); // passes() // true jika sukses, false jika gagal

        // Illuminate\Support\MessageBag // MessageBag package implement pesan error validation
        $message = $validator->getMessageBag(); // getMessageBag():MessageBag // Get pesan error validation.

        Log::error($message->toJson(JSON_PRETTY_PRINT));

        /**
         * result:
         * [2024-06-28 03:12:42] testing.ERROR: {
         * "username": [
         * "The username field is required."
         * ],
         * "password": [
         * "The password field is required."
         * ]
         * }
         * [2024-06-28 03:13:10] testing.ERROR: {
         * "username": [
         * "The username must be a valid email address."
         * ],
         * "password": [
         * "The password must be at least 6 characters."
         * ]
         * }
         */
    }

    public function testValidatorMultipleRulesSuccess(){

        $data = [
            "username" => "budhi@test.com",
            "password" => "rahasiabro",
        ];

        // di sarankan membuat multiple rules denga Array
        $rules = [
            "username" => "required|email|max:100",
            "password" => ["required", "min:6", "max:20"],
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
         * [2024-06-28 03:13:51] testing.ERROR: []
         */
    }

}
