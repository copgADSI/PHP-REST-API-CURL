<?php
define('DS', DIRECTORY_SEPARATOR);
function app_autoload($classname)
{
    $classname = __DIR__ .  DS .  str_replace('\\', DS, $classname) . '.php';
    require_once  $classname;
}

spl_autoload_register('app_autoload');
