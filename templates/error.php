<?php

use App\View;

/**
 * @var View $this
 */

$message = $this->message ?? 'Page Not Found';

?><!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/dist/bundle.css">
    <title><?php echo $message; ?></title>
</head>
<body>
<div class="container">
    <header>
        <h1 class="text-center"><?php echo $message; ?></h1>
    </header>
</html>