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

        <div class="row">
            <h1>Список контактов</h1>
            <?php
            if (!empty($this->contacts)) { ?>
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Фамилия</th>
                        <th scope="col">Телефон</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($this->contacts as $number => $contact) { ?>
                            <tr>
                                <th scope="row">
                                    <?php echo ++$number; ?>
                                </th>
                                <td><?php echo $contact->name; ?></td>
                                <td><?php echo $contact->surname; ?></td>
                                <td><?php echo $contact->phone_number; ?></td>
                                <td class="pt-4">
                                    <a href="/list/<?php echo $contact->id; ?>">
                                        Подробнее
                                    </a>
                                </td>
                                <td>
                                    <form action="/list/<?php echo $contact->id; ?>/delete" method="post">
                                        <button type="submit" class="btn btn-link">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else {?>
                <div class="col-12 text-left mb-3 mt-3">
                   Список пуст
                </div>
            <?php }?>
        </div>
        <a href="/list/add" class="btn btn-lg btn-primary">
            Добавить
        </a>
    </div>
</body>

<script src="/dist/bundle.js"></script>

</html>