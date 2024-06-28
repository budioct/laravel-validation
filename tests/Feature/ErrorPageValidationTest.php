<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ErrorPageValidationTest extends TestCase
{
    /**
     * Error Page
     * ● Saat kita membuat Web, dan menerima input data yang tidak valid, kadang kita ingin menampilkan
     *   error message di halaman web nya
     * ● Kita bisa dengan mudah menampilkan error dari MessageBag di Laravel Blade Template
     * ● Kita cukup menggunakan variable $errors di Blade Template
     * ● https://laravel.com/api/10.x/Illuminate/Support/MessageBag.html
     *
     * Alur Validation Error di Web
     * ● Saat kita membuat form, biasanya kita akan membuat dua halaman. Pertama GET /form untuk
     *   menampilkan form nya, dan POST /form untuk melakukan submit form nya
     * ● Jika terjadi error ketika melakukan POST /form, dan terjadi error ValidationException, secara
     *   otomatis Laravel akan melakukan redirect ke halaman sebelumnya, yaitu GET /form
     * ● Saat melakukan redirect kembali ke halaman GET /form, Laravel akan menyisipkan informasi
     *   sementara object error tersebut ke Session
     * ● Middleware ShareErrorsFromSession akan mendeteksi errors tersebut dan melakukan sharing
     *   informasi ke View sehingga kita bisa dengan mudah menggunakan variable $errors di Blade Temp
     *
     * Error Directive
     * ● Selain menggunakan variable $errors, untuk mendapatkan error by key, kita pernah bahas di kelas
     *   Laravel Blade Template
     * ● Kita bisa menggunakan directive @error(key)
     *
     * Repopulating Forms
     * ● Saat kita melakukan submit form, lalu terjadi error validasi, kadang kita tidak ingin menghapus data
     *   sebelumnya yang sudah di input
     * ● Untungnya, ketika terjadi ValidationException, Laravel menyimpan data yang dikirim ke Session
     *   juga sementara
     * ● Kita bisa menggunakan method old() di Request, atau global function old di Blade template untuk
     *   mendapatkan data lama
     */

    public function testFormSuccessPage(): void
    {

        $this->post("/form", [
            "username" => "budhi",
            "password" => "budhi",
            "_token" => csrf_token(),
        ])->assertStatus(200);

    }

    public function testFormErrorPage(): void
    {

        $this->post("/form", [
            "username" => "",
            "password" => "",
            "_token" => csrf_token(),
        ])->assertStatus(302);

    }

}
