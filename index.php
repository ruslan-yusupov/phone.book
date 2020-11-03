<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/autoload.php';

use App\Models\User;
use App\Router;


$routes = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

$rules = [
        'contacts' => '/contacts/index.php'
];

//$router = new Router($rules, $_SERVER['REQUEST_URI']);
//$router->run();

$user = User::getCurrentUser();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/src/dist/bundle.css">
    <title>Document</title>
</head>
<body class="text-center">

<form class="form-signin"
      method="post"
      action="/auth.php">
    <img class="mb-4 logo"
         src="/src/app/img/logo/logo.png"
         alt="logo">
    <h1 class="h3 mb-3 font-weight-normal">
        Авторизация
    </h1>
    <label for="inputEmail"
           class="sr-only">
        Email
    </label>
    <input type="email"
           id="inputEmail"
           class="form-control"
           name="email"
           placeholder="Email"
           required=""
           autofocus="">
    <label for="inputPassword"
           class="sr-only">
        Пароль
    </label>
    <input type="password"
           id="inputPassword"
           name="password"
           class="form-control"
           placeholder="Пароль"
           required="">
    <div class="checkbox mb-3">
        <label>
            <input type="checkbox"
                   value="remember-me">&nbsp;Запомнить меня
        </label>
    </div>
    <button class="btn btn-lg btn-primary"
            type="submit">
        Войти
    </button>
    <a href="/registration/" class="btn btn-lg btn-secondary">
        Зарегистрироваться
    </a>
    <p class="mt-5 mb-3 text-muted">
        © <?php echo date('Y'); ?>
    </p>
</form>

<?php

if (!empty($user)) { ?>

    <form action="/logout.php" method="post">
        <button type="submit">Выйти</button>
    </form>

<?php } ?>

<script src="/src/dist/bundle.js"></script>
</body>

</html>
