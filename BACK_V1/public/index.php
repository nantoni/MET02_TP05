<?php
require '../vendor/autoload.php';

use \Firebase\JWT\JWT;

$app = new \Slim\App;

const JWT_SECRET = "BrigitteMacronIsASolidFiveOutOfSeven";

$jwt = new \Tuupola\Middleware\JwtAuthentication([
	"path" => "/api",
	"secure" => false,
	"secret" => JWT_SECRET,
	"passthrough" => ["/signin"],
	"attribute" => "decoded_token_data",
	"algorithm" => ["HS256"],
	"error" => function ($response, $arguments) {
		$data = array('ERREUR' => 'ERREUR', 'ERREUR' => 'AUTO');
		return $response->withHeader("Content-Type", "application/json")->getBody()->write(json_encode($data));
	}
]);

$app->add($jwt);

// ROUTES
// client 
$app->get('/api/client/{id}', 'getClient');
$app->post('/api/client', 'addClient');
$app->put('/api/client/{id}', 'updateClient');
$app->delete('/api/client/{id}', 'deleteClient');
// authentication
$app->post('/signin', 'signin');
// produit
$app->get('/api/produits', 'getProduits');
$app->get('/api/produit/{id}', 'getProduit');

// auth
$app->get('/api/authen', authen);



function authen($request, $response, $args)
{
	$token = $request->getAttribute("decoded_token_data");
	return $response->withHeader("Content-Type", "application/json")->withJson($token);
}

function hello($resquest, $response, $args)
{
	return $response->write("{\"nom\":\"$args[name]\"}");
};

function getClient($request, $response, $args)
{
	$id = $args['id'];
	// RECHERCHE
	// ...
	return $response->write(json_encode('{"a":"b"}'));

	// return $response->write (json_encode($client));
}

function addClient($request, $response, $args)
{
	
}

function addLivre($request, $response, $args)
{
	$body = $request->getParsedBody();
	// Parse le body
	$nom = $body['nom']; // Data du formulaire
	// AJOUT
	// ...
	return $response->write("");
}

function updateClient($request, $response, $args)
{
	$id = $args['id'];
	$body = $request->getParsedBody();
	$nom = $body['nom'];
	// Mise a jour
	// ...
	return $response->write("");
}

function deleteClient($request, $response, $args)
{
	$id = $args['id'];
	// Suppression
	// ...
	return $response->write("");
}

function signin($request, $response, $args)
{
	$userid = "emma";
	$email = "emma@emma.fr";
	$issuedAt = time();
	$expirationTime = $issuedAt + 60; // jwt valid for 60 seconds from the issued time
	$payload = array(
		'userid' => $userid,
		'iat' => $issuedAt,
		'exp' => $expirationTime
	);
	$token_jwt = JWT::encode($payload, JWT_SECRET, "HS256");
	$response = $response->withHeader("Authorization", "Bearer {$token_jwt}")->withHeader("Content-Type", "application/json");
	$data = array('name' => 'Emma', 'age' => 48, 'email' => $email);
	return $response->withHeader("Content-Type", "application/json")->withJson($data);
}

function getProduits($request, $response, $args)
{

	// stackoverflow 
	// $path = storage_path("testing/json/test-data.json");
	// $json = file_get_contents($path); 
	// stackoverflow 

}

function getProduit($request, $response, $args)
{ }

// Start app
$app->run();
