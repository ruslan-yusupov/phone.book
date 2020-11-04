<?php

spl_autoload_register(function ($class) {
    $class = str_replace('App', 'src', $class);
    $file = str_replace('\\', '/', $class) . '.php';
    require __DIR__ . '/' . $file;
});
