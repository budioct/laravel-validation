<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
