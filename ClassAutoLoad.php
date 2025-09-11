<?php
require 'conf.php';

// autoload classes from specified directories
$directory = ["Forms", "Globals", "Layouts"];

spl_autoload_register(function ($class_name) use ($directory) {
    foreach ($directory as $dir) {
        $file = __DIR__ . "/$dir/" . $class_name . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// create an instance of the class
$layouts = new layouts($conf);
$forms = new forms();