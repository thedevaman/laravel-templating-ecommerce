<?php
function __autoload($class_name) {
    $file =  'include/classes/'.$class_name .'.php';
    //  echo  $file;
   //exit;
    if(file_exists($file))
    require_once($file);
    else
    die('File Not Found');
}