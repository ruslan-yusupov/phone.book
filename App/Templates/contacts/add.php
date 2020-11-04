<?php

use App\View;

/**
 * @var View $this
 */

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/src/dist/bundle.css">
    <title>Document</title>
    <style>
        input {
            background:rgba(0,0,0,0);
            border:none;
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
<div class="container">
    <header>
        <h1>Добавить контакт</h1>
    </header>
    <form action="/list/add" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleFormControlFile1">Загрузить фото</label>
            <input type="file" class="form-control-file" name="picture" id="exampleFormControlFile1">
        </div>
        <!--<div class="form-group">
            <label for="exampleInputEmail1">Имя</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Фамилия</label>
            <input type="text" class="form-control" name="surname" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Email</label>
            <input type="text" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Номер телефона</label>
            <input type="text" class="form-control" name="phone_number" required>
        </div>-->
        <button type="submit" class="btn btn-primary">Submit</button>

    </form>

</html>