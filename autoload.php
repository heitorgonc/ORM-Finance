<?php

spl_autoload_register(function(string $class){
    $file = preg_replace("/^App(.*)/", __DIR__ . '/src$1.php', $class);
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
    
    require_once $file;
});