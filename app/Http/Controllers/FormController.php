<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class FormController extends Controller
{

    public function form(): Response
    {
        return response()->view("form");
    }

    public function submitForm(Request $request): Response
    {
        // note: kita tidak perlu try catch untuk handle validation di request http web atau http api,, karna sudah otomatis di handle laravel

        // validasi cara 1
        $rules = [
            "username" => ["required"],
            "password" => ["required"],
        ];
        $data = $request->validate($rules);

        // validasi cara 2
        //$data = $request->validate([
        //    "username" => ["required"],
        //    "password" => ["required"],
        //]);

        // lakukan hasil $data yang sudah di validasi
        return response("OK", Response::HTTP_OK);

    }

    public function formWithFormRequest(): Response
    {
        return response()->view("form_request");
    }

    public function submitFormWithFormRequest(LoginRequest $request): Response{

        // note: kita tidak perlu try catch untuk handle validation di request http web atau http api,, karna sudah otomatis di handle laravel

        // cara validasi menggunakan FormRequest fitur Laravel
        $data = $request->validated();
        Log::info(json_encode($request->all(), JSON_PRETTY_PRINT));

        // lakukan hasil $data yang sudah di validasi
        return response("OK", Response::HTTP_OK);

        /**
         * result: implementasi FormRequest
         * [2024-06-28 12:44:14] local.INFO: {"username":"budhi@test.com","password":"2334kfjskf@sdkfj"}
         *
         * result: implementasi prepareForValidation() sebelum validasi dan passedValidation() setelah validasi
         * [2024-06-28 12:54:10] local.INFO: {
         * "_token": "m9GirRxnG12fnicveb39Rct78i0DgAvEOckDwdbh",
         * "username": "budhi@test.com",
         * "password": "$2y$10$7U534UsR7ojBBsWAcovPOOyoiv2yBpNWnV1fvEmITS8zJ2GhPIZ6O"
         * }
         */
    }

    public function login(Request $request): Response
    {
        try {

            // validasi cara 1
            $rules = [
                "username" => ["required"],
                "password" => ["required"],
            ];
            $data = $request->validate($rules);

            // validasi cara 2
            //$data = $request->validate([
            //    "username" => ["required"],
            //    "password" => ["required"],
            //]);

            // lakukan hasil $data yang sudah di validasi

            return response("OK", Response::HTTP_OK);

        } catch (ValidationException $exception) {

            return response($exception->errors(), Response::HTTP_BAD_REQUEST);
        }


    }

}
