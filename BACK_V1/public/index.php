<?php
require '../vendor/autoload.php';

use \Firebase\JWT\JWT;

$app = new \Slim\App;

const JWT_SECRET = "myKey1234567";

$jwt = new \Slim\Middleware\JwtAuthentication([
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
$app->get('/client/{id}', 'getClient');
$app->post('/client', 'addClient');
$app->put('/client/{id}', 'updateClient');
$app->delete('/client/{id}', 'deleteClient');
// authentication
$app->post('/signin', 'signin');
// produit
$app->get('/produits', 'getProduits');
$app->get('/produit/{id}', 'getProduit');


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

}

function getProduits($request, $response, $args)
{

	// stackoverflow 
	// $path = storage_path("testing/json/test-data.json");
	// $json = file_get_contents($path); 
	// stackoverflow 

}

function getProduit($request, $response, $args)
{ 
	
}

// Start app
$app->run();
