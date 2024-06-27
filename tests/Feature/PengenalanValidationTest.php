<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PengenalanValidationTest extends TestCase
{
    /**
     * Pengenalan Laravel Validation
     *
     * Validation
     * ● Saat kita membuat aplikasi, sudah dipastikan bahwa kita akan selalu menambahkan validasi
     *   terhadap data yang diterima oleh aplikasi
     * ● Di database, saat membuat tabel pun, biasanya kita menambahkan validasi, misal kolom yang tidak
     *   boleh null, atau unique, atau menambahkan check constraint
     * ● Validasi adalah proses yang dilakukan untuk menjaga agar data di aplikasi kita tetap konsisten dan baik
     * ● Tanpa validasi, data di aplikasi bisa rusak dan tidak konsisten
     *
     * Manual Validation
     * ● Saat kita menggunakan Laravel, validasi secara manual sangat tidak direkomendasikan
     * ● Misal melakukan pengecekan apakah input data berisi string kosong, atau apakah input data
     *   berupa angka, tanggal, dan lain-lain
     * ● Hal ini bisa saja kita lakukan secara manual, dan lakukan pengecekan menggunakan if statement
     * ● Namun, hal ini tidak direkomendasikan
     * ● Untungnya, Laravel menyediakan fitur untuk melakukan Validasi
     *
     * Laravel Validation
     * ● Laravel menyediakan fitur untuk melakukan validasi menggunakan Class bernama Validator
     * ● https://laravel.com/api/10.x/Illuminate/Validation/Validator.html
     * ● Di kelas ini, kita akan fokus membahas bagaimana cara menggunakan Laravel Validation, untuk
     *   mempermudah melakukan validasi data yang diterima oleh aplikasi Laravel kita
     */
}
