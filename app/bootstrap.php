<?php
session_start();

require_once "config/config.php";
require_once "functions.php";

spl_autoload_register(function ($className){
    require_once 'libraries/'.$className.'.php';
});