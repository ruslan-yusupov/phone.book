<?php

use App\View;

/**
 * @var View $this
 */

?><!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/dist/bundle.css">
    <title>Список контактов</title>
</head>
<body>
    <div class="container">

        <div class="row flex-row-reverse mb-5">
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
            <h1 class="mb-3">Список контактов</h1>

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

                <tbody data-contacts-table>
                    <?php
                    if (!empty($this->contacts)) {
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
                        <?php }
                    } ?>
                </tbody>
            </table>
        </div>

        <?php if (empty($this->contacts)) {?>
            <div class="row text-left mb-3 mt-3" data-empty-block>
                Список контактов пуст
            </div>
        <?php } ?>

        <?php require_once __DIR__ . '/form.php'; ?>
    </div>

    <script src="/dist/bundle.js"></script>

</body>


</html>