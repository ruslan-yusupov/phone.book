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
    <link rel="stylesheet" href="/dist/bundle.css">
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
    <div class="row flex-row-reverse">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Пользователь</h5>
                <h6 class="card-subtitle mb-2 text-muted">Логин: <?php echo $this->user->login; ?></h6>
                <h6 class="card-subtitle mb-2 text-muted">Email: <?php echo $this->user->email; ?></h6>
                <a href="/logout" class="card-link">Выйти</a>
            </div>
        </div>
    </div>
    <header>
        <h1>Добавить контакт</h1>
    </header>
    <form action="/list/add" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="picture">Загрузить фото</label>
            <input type="file" class="form-control-file" name="picture" id="picture">
        </div>
        <div class="form-group">
            <label for="name">Имя</label>
            <input type="text"
                   class="form-control"
                   id="name"
                   name="name"
                   value=""
                   placeholder="Имя">
        </div>
        <div class="form-group">
            <label for="surname">Фамилия</label>
            <input type="text"
                   class="form-control"
                   id="surname"
                   name="surname"
                   value=""
                   placeholder="Фамилия">
        </div>
        <div class="form-group">
            <label for="phone_number">Телефон</label>
            <input type="text"
                   class="form-control"
                   id="phone_number"
                   name="phone_number"
                   value=""
                   placeholder="Телефон">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text"
                   class="form-control"
                   id="email"
                   name="email"
                   value=""
                   placeholder="Email">
        </div>
        <button type="submit" class="btn btn-primary">Добавить</button>

    </form>

</html>