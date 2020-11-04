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
    <div>
        <div class="card">
            <img src="/uploads/<?php echo $this->contact->picture; ?>"
                 class="card-img-top"
                 alt="<?php echo $this->contact->name; ?>">
        </div>
        <div class="form-group">
            <label for="name">Имя</label>
            <input type="text"
                   class="form-control"
                   id="name"
                   name="name"
                   readonly
                   value="<?php echo $this->contact->name; ?>"
                   placeholder="Имя">
        </div>
        <div class="form-group">
            <label for="surname">Фамилия</label>
            <input type="text"
                   class="form-control"
                   id="surname"
                   name="surname"
                   readonly
                   value="<?php echo $this->contact->surname; ?>"
                   placeholder="Фамилия">
        </div>
        <div class="form-group">
            <label for="phone_number">Телефон</label>
            <input type="text"
                   class="form-control"
                   id="phone_number"
                   name="phone_number"
                   readonly
                   value="<?php echo $this->contact->phone_number; ?>"
                   placeholder="Телефон">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text"
                   class="form-control"
                   id="email"
                   name="email"
                   readonly
                   value="<?php echo $this->contact->email; ?>"
                   placeholder="Email">
        </div>
    </div>
    <form action="/list/<?php echo $this->contact->id; ?>/delete" method="post">
        <a href="/list" class="btn btn-link">Вернуться в список</a>
        <button type="submit" class="btn btn-secondary">Удалить</button>
    </form>

</body>

<script src="/dist/bundle.js"></script>

</html>