<?php
//reference to autoLoader function
spl_autoload_register('autoLoader'); 

//get all classes from classes directory 
function autoLoader($class){
    $directory = "../classes/";
    $ext = ".php";
    $fullpath = $directory . $class . $ext;

    if (!file_exists($fullpath)){
        return false; //check if class file exists
    }

    include_once($fullpath);
}