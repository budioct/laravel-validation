<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomRequestValidationTest extends TestCase
{
    /**
     * Custom Request
     * ● Saat kita membuat form request yang kompleks, ada baiknya kita membuat class sendiri untuk
     *   Form Request tersebut
     * ● Salah satu kelebihannya dengan membuat form request sendiri, bisa diintegrasikan dengan Laravel Validator
     * ● Hal ini membuat kode yang kita buat lebih rapi, karena data Request dan Validasi terpisah dari
     *   kode Controller
     *
     * Membuat Form Request
     * ● Untuk membuat Form Request sendiri, kita bisa menggunakan perintah :
     *   php artisan make:request NamaFormRequest
     * ● Walaupun namanya Form Request, namun sebenarnya kita tetap bisa menggunakannya ketika
     *   misal kita ingin menerima data dalam bentuk JSON misalnya
     *
     * // php artisan make:request LoginRequest
     *
     * FormRequest Class
     * ● Form Request adalah class turunan dari FormRequest
     * ● https://laravel.com/api/10.x/Illuminate/Foundation/Http/FormRequest.html
     * ● Untuk menambahkan Rule untuk validasi, kita bisa menggunakan method rules()
     * ● Untuk menambahkan Additional Validator setelah validasi, kita bisa gunakan method after()
     * ● Jika ingin berhenti melakukan validasi, setelah terdapat satu attribute yang error, kita bisa
     *   gunakan property $stopOnFirstFailure
     * ● Jika ingin mengubah halaman redirect ketika terjadi ValidationException, kita bisa gunakan
     *   property $redirect (URL) atau $redirectRoute (Route)
     * ● Jika ingin menambahkan authentication sebelum melakukan Validasi, kita bisa menggunakan
     *   method authorize()
     * ● Untuk mengubah default message, kita bisa menggunakan method messages()
     * ● Untuk mengubah default nama attribute, kita bisa menggunakan method attributes()
     *
     * Before dan After Validation
     * ● Jika kita ingin melakukan sesuatu sebelum melakukan validasi, misal membersihkan data yang
     *   tidak dibutuhkan, kita bisa menggunakan method prepareForValidation()
     * ● Sedangkan jika kita ingin melakukan sesuai sesudah validasi, kita bisa menggunakan method
     *   passedValidation()
     */
}
