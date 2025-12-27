<?php
	define('BASE_DIR', dirname(__DIR__));
    define('sp', DIRECTORY_SEPARATOR);
    define('DOMAIN', 'http://localhost/rdc/');

    spl_autoload_register(function ($class) {
        $file = __DIR__ .sp . str_replace('\\', sp, $class) . '.php';
        if (file_exists($file)) {
            require $file;
        }
    });