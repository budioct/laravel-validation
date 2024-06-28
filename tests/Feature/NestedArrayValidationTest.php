<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class NestedArrayValidationTest extends TestCase
{
    /**
     * Nested Array Validation
     * ● Saat kita melakukan validasi, kadang data yang kita validasi tidak hanya berformat key-value
     * ● Kadang terdapat nested array, misal terdapat key address, dimana di dalamnya berisi array lagi
     * ● Pada kasus data jenis nested array, kita bisa membuat Rule menggunakan tanda . (titik), misal
     *   address.street, address.city, dan lain-lain
     * ● Jika masih terdapat nested array, kita bisa tambahkan . (titik) lagi
     *
     * // note: untuk validasi nedted array hanya tambahkan titik .
     * // contoh data
     * "name" => [
     *            "first" => "budhi",
     *            "last" => "octaviansyah"
     * ];
     * // contoh rules
     * seperti:  name.first, name.last, dan lain-lain
     *
     */

    public function testValidationNestedArrayInvalid()
    {

        // validasi data yang nested array
        $data = [
            "name" => [
                "first" => "",
                "last" => ""
            ],
            "adddress" => [
                "street" => "Jl. maju mundur",
                "city" => "",
                "country" => "Indonesia"
            ]
        ];

        // di sarankan membuat multiple rules denga Array
        // auturan validasi untuk nedted array
        $rules = [
            "name.first" => ["required", "max:100"],
            "name.last" => ["max:100"],
            "adddress.street" => ["max:100"],
            "adddress.city" => ["required", "max:100"],
            "adddress.country" => ["required", "max:100"],
        ];

        // Illuminate\Support\Facades\Validator; // Validator package implement validation untuk laravel
        $validator = Validator::make($data, $rules); // make(array $data, array $rules) // method yang check validasi
        self::assertTrue($validator->fails());

        // Illuminate\Support\MessageBag // MessageBag package implement pesan error validation
        $validator->getMessageBag(); // getMessageBag():MessageBag // Get pesan error validation.

        // Illuminate\Support\MessageBag // MessageBag package implement pesan error validation
        $message = $validator->getMessageBag(); // getMessageBag():MessageBag // Get pesan error validation.

        Log::error($message->toJson(JSON_PRETTY_PRINT));

        /**
         * result:
         * [2024-06-28 08:37:09] testing.ERROR: {
         * "name.first": [
         * "The name.first field is required."
         * ],
         * "adddress.city": [
         * "The adddress.city field is required."
         * ]
         * }
         */

    }

    public function testValidationNestedArraySuccess()
    {

        $data = [
            "name" => [
                "first" => "budhi",
                "last" => "octaviansyah"
            ],
            "adddress" => [
                "street" => "Jl. maju mundur",
                "city" => "Jakarta",
                "country" => "Indonesia"
            ]
        ];

        // di sarankan membuat multiple rules denga Array
        // auturan validasi
        $rules = [
            "name.first" => ["required", "max:100"],
            "name.last" => ["max:100"],
            "adddress.street" => ["max:100"],
            "adddress.city" => ["required", "max:100"],
            "adddress.country" => ["required", "max:100"],
        ];

        // Illuminate\Support\Facades\Validator; // Validator package implement validation untuk laravel
        $validator = Validator::make($data, $rules); // make(array $data, array $rules) // method yang check validasi
        self::assertTrue($validator->passes());

        // Illuminate\Support\MessageBag // MessageBag package implement pesan error validation
        $validator->getMessageBag(); // getMessageBag():MessageBag // Get pesan error validation.

        // Illuminate\Support\MessageBag // MessageBag package implement pesan error validation
        $message = $validator->getMessageBag(); // getMessageBag():MessageBag // Get pesan error validation.

        Log::error($message->toJson(JSON_PRETTY_PRINT));

        /**
         * [2024-06-28 08:37:10] testing.ERROR: []
         */
    }

    /**
     *  Indexed Array Validation
     *  ● Pada beberapa kasus, misal nested array nya adalah indexed, artinya bisa lebih dari satu
     *  ● Pada kasus ini, kita tidak menggunakan . (titik), melainkan menggunakan * (bintang)
     *
     * note: // note: untuk validasi nedted array hanya tambahkan bintang *
     * // contoh data
     * "address" => [
     *                  [
     *                   "street" => "Jalan. Jeruk",
     *                   "city" => "Jakarta",
     *                   "country" => ""
     *                  ],
     *                  [
     *                   "street" => "Jalan. Manggis",
     *                   "city" => "",
     *                   "country" => ""
     *                  ]
     *              ]
     *
     * // contoh rules seperti: address.*.street, address.*.city, address.*.country
     */

    public function testNestedIndexedArrayInvalid()
    {
        $data = [
            "name" => [
                "first" => "Eko",
                "last" => "Kurniawan"
            ],
            "address" => [
                [
                    "street" => "Jalan. Jeruk",
                    "city" => "Jakarta",
                    "country" => ""
                ],
                [
                    "street" => "Jalan. Manggis",
                    "city" => "",
                    "country" => ""
                ]
            ]
        ];

        $rules = [
            "name.first" => ["required", "max:100"],
            "name.last" => ["max:100"],
            "address.*.street" => ["max:200"],
            "address.*.city" => ["required", "max:100"],
            "address.*.country" => ["required", "max:100"],
        ];

        // Illuminate\Support\Facades\Validator; // Validator package implement validation untuk laravel
        $validator = Validator::make($data, $rules); // make(array $data, array $rules) // method yang check validasi
        self::assertTrue($validator->fails());

        // Illuminate\Support\MessageBag // MessageBag package implement pesan error validation
        $validator->getMessageBag(); // getMessageBag():MessageBag // Get pesan error validation.

        // Illuminate\Support\MessageBag // MessageBag package implement pesan error validation
        $message = $validator->getMessageBag(); // getMessageBag():MessageBag // Get pesan error validation.

        Log::error($message->toJson(JSON_PRETTY_PRINT));

        /**
         * result:
         * [2024-06-28 08:41:05] testing.ERROR: {
         * "address.1.city": [
         * "The address.1.city field is required."
         * ],
         * "address.0.country": [
         * "The address.0.country field is required."
         * ],
         * "address.1.country": [
         * "The address.1.country field is required."
         * ]
         * }
         */

    }

    public function testNestedIndexedArraySuccess()
    {
        $data = [
            "name" => [
                "first" => "Eko",
                "last" => "Kurniawan"
            ],
            "address" => [
                [
                    "street" => "Jalan. Jeruk",
                    "city" => "Jakarta",
                    "country" => "Indonesia"
                ],
                [
                    "street" => "Jalan. Manggis",
                    "city" => "Bandung",
                    "country" => "Indonesia"
                ]
            ]
        ];

        $rules = [
            "name.first" => ["required", "max:100"],
            "name.last" => ["max:100"],
            "address.*.street" => ["max:200"],
            "address.*.city" => ["required", "max:100"],
            "address.*.country" => ["required", "max:100"],
        ];

        // Illuminate\Support\Facades\Validator; // Validator package implement validation untuk laravel
        $validator = Validator::make($data, $rules); // make(array $data, array $rules) // method yang check validasi
        self::assertTrue($validator->passes());

        // Illuminate\Support\MessageBag // MessageBag package implement pesan error validation
        $validator->getMessageBag(); // getMessageBag():MessageBag // Get pesan error validation.

        // Illuminate\Support\MessageBag // MessageBag package implement pesan error validation
        $message = $validator->getMessageBag(); // getMessageBag():MessageBag // Get pesan error validation.

        Log::error($message->toJson(JSON_PRETTY_PRINT));

        /**
         * result:
         * [2024-06-28 08:46:06] testing.ERROR: []
         */

    }

}
