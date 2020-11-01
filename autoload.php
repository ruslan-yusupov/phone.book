<?php

spl_autoload_register(function ($class) {
    $file = str_replace('\\', '/', $class);
    require __DIR__ . '/' . $file;
});
