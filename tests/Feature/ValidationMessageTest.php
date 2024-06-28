<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class ValidationMessageTest extends TestCase
{
    /**
     * Validation Message
     * ● Setiap Rule di Laravel Validator, memiliki validation message
     * ● Secara default, message-nya menggunakan bahasa Inggris, namun kita bisa mengubahnya jika kita mau
     * ● Semua message di Laravel akan disimpan di dalam folder lang/{locale}/
     * ● Jika belum ada folder dan file nya, kita bisa gunakan perintah dibawah ini untuk membuat default
     *   message :
     *   php artisan lang:publish
     * ● Validation message, terdapat di file validation.php
     *
     * note: jadi default data validation ada di folder ../lang/en/validation.php --> semua datanya ada di sini
     *
     * Custom Message untuk Attribute
     * ● Kadang, pada beberapa kasus, kita tidak ingin menggunakan default message saat melakukan validasi
     * ● Kita bisa menambah Custom Message untuk Attribute, di file validation.php
     * // kita bisa customer untuk pesan error validation
     */

    public function testValidationMessageCustom(){

        // cara ini di rekomendasikan supaya mudah diatur

        $data = [
            "username" => "budhi",
            "password" => "rahasia",
        ];

        // di sarankan membuat multiple rules denga Array
        // auturan validasi
        $rules = [
            "username" => ["required", "email", "max:100"], // rules email sudah kita custom
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
         * result: pesan error tampilkan di custom
         * [2024-06-28 04:00:15] testing.ERROR: {
         * "username": [
         * "We only accept email address for username"
         * ]
         * }
         */
    }

    /**
     * Localization
     * ● Message di Laravel, mendukung multi bahasa
     * ● Caranya kita cukup membuat folder dengan kode locale pada folder lang, dan buat file php
     *   validation yang berisi attribute sama
     * ● Kita bisa mengubah nilai message nya, sesuai dengan bahasanya
     * ● Untuk mengaktifkan bahasa yang ingin kita gunakan, kita bisa gunakan Facade App::setLocale()
     * ● Jika locale yang kita pilih tidak tersedia, maka secara otomatis akan menggunakan default locale
     *
     * note: jadi data validation ada di folder ../lang/id/validation.php --> semua datanya ada di sini untuk I18N indonesia
     */

    public function testValidationMessageCustomLocalization(){

        // cara ini di rekomendasikan supaya mudah diatur

        // Illuminate\Support\Facades\App
        App::setlocale('id'); // setlocale("id_localization") // mengaktifkan bahasa yang ingin kita gunakan

        $data = [
            "username" => "budhi",
            "password" => "budhi",
        ];

        // di sarankan membuat multiple rules denga Array
        // auturan validasi
        $rules = [
            "username" => ["required", "email", "max:100"], // rules email sudah kita custom
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
         * result: pesan error tampilkan di custom
         * [2024-06-28 04:08:15] testing.ERROR: {
         * "username": [
         * "Kami hanya menerima email sebagai user id"
         * ],
         * "password": [
         * "The password minimal harus 6 karakter."
         * ]
         * }
         */
    }

    /**
     * Inline Message
     * ● Kadang, mengubah message file di folder lang mungkin terlalu ribet
     * ● Kita bisa menambahkan message pada parameter ketiga saat membuat Validator menggunakan
     *   Validator::make(data, rules, messages)
     * ● Secara otomatis, Validator akan mengambil message yang terdapat parameter messages, dan jika
     *   tidak ada, maka akan mengambil dari folder lang
     */

    public function testValidationMessageCustomInlineMessage(){

        // tidak di sarankan

        $data = [
            "username" => "budhi",
            "password" => "budhi",
        ];

        // di sarankan membuat multiple rules denga Array
        // auturan validasi
        $rules = [
            "username" => ["required", "email", "max:100"], // rules email sudah kita custom
            "password" => ["required", "min:6", "max:20"],
        ];

        // pesan error validasi (custom)
        $messages = [
            "required" => ":attribute harus diisi",
            "email" => ":attribute harus berupa email",
            "min" => ":attribute minimal :min karakter",
            "max" => ":attribute maximal :max karakter",
        ];

        // Illuminate\Support\Facades\Validator; // Validator package implement validation untuk laravel
        $validator = Validator::make($data, $rules, $messages); // make(array $data, array $rules, array $messages = []) // method yang check validasi
        self::assertNotNull($validator);

        self::assertTrue($validator->fails()); // fails() // true jika gagal, false jika sukses
        self::assertFalse($validator->passes()); // passes() // true jika sukses, false jika gagal

        // Illuminate\Support\MessageBag // MessageBag package implement pesan error validation
        $message = $validator->getMessageBag(); // getMessageBag():MessageBag // Get pesan error validation.

        Log::error($message->toJson(JSON_PRETTY_PRINT));

        /**
         * result: pesan error tampilkan di custom
         * [2024-06-28 04:14:21] testing.ERROR: {
         * "username": [
         * "username harus berupa email"
         * ],
         * "password": [
         * "password minimal 6 karakter"
         * ]
         * }
         */
    }


}
