<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$path=findParentPath('vendor');
require_once $path . '/autoload.php';
spl_autoload_register(function ($class) {
    $path=findParentPath('src');
    if (strpos($class, 'Core') !== false) {
        $location=  str_replace('\\', '/', $path . '/' . $class . '.php');
        
        include $location;
    }
});

function findParentPath( $path ) {
    $dir         = __DIR__;
    $previousDir = '.';
    while (!is_dir($dir . '/' . $path)) {
        $dir         = dirname($dir);
        if ($previousDir === $dir){
            return false;
        }
        $previousDir = $dir;
    }
    return $dir . '/' . $path;
}
