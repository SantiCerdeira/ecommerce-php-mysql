<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

spl_autoload_register(function ($className){
    $className = substr($className, 11);

    $filename = __DIR__ . '/../clases/' . $className . '.php';

    $filename = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $filename);
    
    if(file_exists($filename)) {
        require_once $filename;
    }
});