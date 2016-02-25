<?php
//Load Bootstrap File
require dirname(__DIR__) . DIRECTORY_SEPARATOR.'boostrap.php';
//Load Composer if have Autoload
if (file_exists(ROOT . 'vendor/autoload.php')) {
    require ROOT . 'vendor/autoload.php';
}
