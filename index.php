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

$app->post('/User', function ($request, $response, $args) use($api) 
{
	$params = $request->getParsedBody();
	$birthday = $params['u_birthday'];
	$name = $params['u_name'];
	$nickname = $params['u_nickname'];
	$phone = $params['u_phon'];
	if($name == null)
	{
		$json_data = array
        (
            "error" => "E1003",
            "data" => ""
        );

		$row = json_encode($json_data);
	}
	else
	{
		$row = $api->sp_insert_User($birthday,$name,$nickname,$phone);
	}
	
	$response->getBody()->write($row);
	return $response;
});

$app->run();

?>