
<?php

session_start();
include "core/autoload.php";

define('ROOT_PATH', dirname(__DIR__) . '/sistema/'); 

$lb = new Lb();
$lb->loadModule("index");

?>