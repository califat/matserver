<?php
require "vendor\autoload.php";
use Router\Router;
use Dotenv\Dotenv;
use AppDefender\AppDefender;


$Dotenv 	=new Dotenv(__DIR__);
$Dotenv->load();

$LoadEnv 	=new LoadEnv;

echo $LoadEnv->SECRET_KEY;

use controller\controller;
setlocale(LC_ALL, 'fr_CA.utf-8');
(new controller);
