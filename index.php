<?php 
require __DIR__ . '/global_var.php';
require __DIR__ . '/vendor/autoload.php';
require __DIR__ .'/DBHandler.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Factory\AppFactory;
use Slim\Views\PhpRenderer;
use DBManager\DBHandler;

$app = AppFactory::create();
$api = new DBHandler();

$app->addBodyParsingMiddleware();
$app->setBasePath("/test");

session_start();

$app->get('/user/{uid}', function ($request, $response, $args) use($api) 
{	
	$uid = $request->getAttribute('uid');
	$row = $api->sp_select_User($uid);
	$response->getBody()->write($row);
	return $response;
});

$app->run();

?>