<?php
function __autoload($class) {
    if(file_exists('model/'.strtolower($class) . '.class.php')) {
        require_once('model/'.strtolower($class) . '.class.php');
    } else {
        throw new Exception("Unable to load $class.");
    }
}
