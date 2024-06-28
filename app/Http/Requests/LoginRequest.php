<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class LoginRequest extends FormRequest
{
    /**
     *  FormRequest Class
     *  ● Form Request adalah class turunan dari FormRequest
     *  ● https://laravel.com/api/10.x/Illuminate/Foundation/Http/FormRequest.html
     *  ● Untuk menambahkan Rule untuk validasi, kita bisa menggunakan method rules()
     *  ● Untuk menambahkan Additional Validator setelah validasi, kita bisa gunakan method after()
     *  ● Jika ingin berhenti melakukan validasi, setelah terdapat satu attribute yang error, kita bisa
     *    gunakan property $stopOnFirstFailure
     *  ● Jika ingin mengubah halaman redirect ketika terjadi ValidationException, kita bisa gunakan
     *    property $redirect (URL) atau $redirectRoute (Route)
     *  ● Jika ingin menambahkan authentication sebelum melakukan Validasi, kita bisa menggunakan
     *    method authorize()
     *  ● Untuk mengubah default message, kita bisa menggunakan method messages()
     *  ● Untuk mengubah default nama attribute, kita bisa menggunakan method attributes()
     *
     * Before dan After Validation
     *  ● Jika kita ingin melakukan sesuatu sebelum melakukan validasi, misal membersihkan data yang
     *    tidak dibutuhkan, kita bisa menggunakan method prepareForValidation()
     *  ● Sedangkan jika kita ingin melakukan sesuai sesudah validasi, kita bisa menggunakan method
     *    passedValidation()
     */

    /**
     * rules() kita akan buat rules / aturan validasi untuk tiap attribute/field
     *
     * // di sarankan membuat multiple rules denga Array
     * // auturan validasi sekarang menggunakan class..
     * // static class Password --> bisa memberikan validation pipline,
     * // min(6) minimal 6 karakter,
     * // letters() harus ada huruf,
     * // numbers() harus ada nomer,
     * // symbols() harus ada symbol
     */
    public function rules(): array
    {
        return [
            "username" => ["required", "email", "max:100"],
            "password" => ["required", Password::min(6)->letters()->numbers()->symbols()],
        ];
    }

    // prepareForValidation() // Jika kita ingin melakukan sesuatu sebelum melakukan validasi
    // jadi dalam kasus ini ketika request masuk maka akan di lowercase setiap property/attribute/field yang masuk ke controller.
    protected function prepareForValidation()
    {
        $this->merge([
            "username" => strtolower($this->input("username")),
        ]);
    }

    // passedValidation() // jika kita ingin melakukan sesuai sesudah validasi
    // jadi dalam kasus ini ketika request masuk dan sudah selesai melewati proses validasi maka akan di enkripsi dengan package Bcrypt untuk property/attribute/field tertentu yang akan di teruskan ke database.
    protected function passedValidation()
    {
        $this->merge([
            "password" => bcrypt($this->input("password")),
        ]);
    }
}
