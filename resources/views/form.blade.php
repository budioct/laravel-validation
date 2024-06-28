<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Validation Form</title>
</head>
<body>

<!--
$errors variable global yang digunakan untuk ambil pesan error yang ada di SESSION yang sebelumnya di kirim oleh object \Illuminate\Support\MessageBag (handle pesan error validation)
any() method return boolean
all() mendapatkan semua pesan error return array[]

cara kerja validation.. jika kita terkena validation setelah klik tombol submit maka kita akan di redirect ke halaman ini lagi dengan status_code: 302

Selain menggunakan variable $errors, untuk mendapatkan error by key
Kita bisa menggunakan directive @_error("key") // key adalah attribute/field yang terkena validation rules/aturan
$message variable global yang akan print pesan error validation dari object \Illuminate\Support\MessageBag (handle pesan error validation)

Kita bisa menggunakan method old(key) // key adalah attribute/field yang terkena validation rules/aturan,
di Request, atau global function old di Blade template untuk mendapatkan data lama yang di simpan sementara Session
jadi saat terkena exception validation data pada form input tidak hilang
-->
@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="/form" method="post">
    @csrf
    <label>Username: @error("username") {{ $message }} @enderror
        <input type="text" name="username" value="{{ old("username") }}"></label><br>
    <label>Password: @error("password") {{ $message }} @enderror
        <input type="password" name="password" value="{{ old("password") }}"></label><br>
    <input type="submit" value="Login">
</form>


</body>
</html>
