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
    <label>Username: <input type="text" name="username"></label><br>
    <label>Password: <input type="password" name="password"></label><br>
    <input type="submit" value="Login">
</form>


</body>
</html>
