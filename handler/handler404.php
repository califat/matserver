<?php
if(!file_exists("vendor/autoload.php")){
	die();
}
require "vendor/autoload.php";
use Handler\Handler;
use Router\Router;

if(Router::isAjax()):
	header('Content-Type :application/json');
 	echo json_encode('Error');
 	http_response_code(404);
 	die();
endif;

?>

<p style="margin: 100px auto;position: relative;width: 100px;padding: 10px 0;text-align: center;background-color: red;color: #fff;font-family: arial;">Error 404</p>

