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

		if (is_array($row)) {
			$row = json_encode($row);
		}
	}
	
	$response->getBody()->write($row);
	return $response;
});

$app->post('/category', function ($request, $response, $args) use($api) 
{
	$params = $request->getParsedBody();
	$name = $params['name'];
	$description = $params['description'];
	$type = $params['type'];
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
		$row = $api->sp_insert_category($name,$description,$type);

		if (is_array($row)) {
			$row = json_encode($row);
		}
	}
	
	$response->getBody()->write($row);
	return $response;
});

$app->post('/board', function ($request, $response, $args) use($api) 
{
	$params = $request->getParsedBody();
	$title = $params['title'];
	$body = $params['body'];
	if($title == null)
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
		$row = $api->sp_insert_board($title,$body);

		if (is_array($row)) {
			$row = json_encode($row);
		}
	}
	
	$response->getBody()->write($row);
	return $response;
});

$app->post('/order', function ($request, $response, $args) use($api) 
{
	$params = $request->getParsedBody();
	$name = $params['name'];
	$type = $params['type'];
	$uid = $params['u_id'];
	if($uid == null)
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
		$row = $api->sp_insert_order($name,$type,$uid);

		if (is_array($row)) {
			$row = json_encode($row);
		}
	}
	
	$response->getBody()->write($row);
	return $response;
});

$app->post('/menu', function ($request, $response, $args) use($api) 
{
	$params = $request->getParsedBody();
	$description = $params['description'];
	$name = $params['name'];
	$price = $params['price'];
	$image_url = $params['image_url'];
	$category_id = $params['category_id'];
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
		$row = $api->sp_insert_order($description,$name,$price,$image_url,$category_id);

		if (is_array($row)) {
			$row = json_encode($row);
		}
	}
	
	$response->getBody()->write($row);
	return $response;
});

/*
$app->post('/menu', function ($request, $response, $args) use($api) 
{
	$params = $request->getParsedBody();
	$description = $params['description'];
	$name = $params['name'];
	$price = $params['price'];
	$image_url = $params['image_url'];
	$category_id = $params['category_id'];
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
		$row = $api->sp_insert_order($description,$name,$price,$image_url,$category_id);

		if (is_array($row)) {
			$row = json_encode($row);
		}
	}
	
	$response->getBody()->write($row);
	return $response;
}); */

$app->run();

?>