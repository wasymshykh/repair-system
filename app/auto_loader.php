<?php

spl_autoload_register('ldr');

function ldr ($className)
{
    $path = DIR."classes/";
    $ext = ".class.php";
    $full = $path . strtolower($className) . $ext;
    if (file_exists($full)) {
        require_once $full;
    }
}

// composer autoload
require_once DIR.'vendor/autoload.php';
