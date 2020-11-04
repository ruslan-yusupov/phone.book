<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/src/dist/bundle.css">
    <title>Авторизация</title>
</head>
<body class="text-center">

<form class="form"
      method="post"
      action="/auth">
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
    <button class="btn btn-lg btn-primary"
            type="submit">
        Войти
    </button>
    <a href="/registration" class="btn btn-lg btn-secondary">
        Зарегистрироваться
    </a>
    <p class="mt-5 mb-3 text-muted">
        © <?php echo date('Y'); ?>
    </p>
</form>

<script src="/src/dist/bundle.js"></script>
</body>

</html>
