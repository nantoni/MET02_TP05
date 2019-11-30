<?php
require '../../vendor/autoload.php';
$app = new \Slim\App;

$app->get('/hello/{name}',
function ($resquest,$response,$args) {
	return $response->write("{\"nom\":\"$args[name]\"}");
});

$app->get('/client/{id}', 'getClient');
$app->post('/client', 'addClient');
$app->put('/client/{id}', 'updateClient');
$app->delete('/client/{id}', 'deleteClient');



function getClient($request,$response,$args) {
	$id = $args['id'];
	// RECHERCHE
	// ...
	return $response->write (json_encode($client));
}

function addLivre($request,$response,$args) {
	$body = $request->getParsedBody();
	// Parse le body
	$nom = $body['nom']; // Data du formulaire
	// AJOUT
	// ...
	return $response->write ("");
}

function updateClient($request,$response,$args) {
	$id = $args['id'];
	$body = $request->getParsedBody();
	$nom = $body['nom'];
	// Mise a jour
	// ...
	return $response->write ("");
}


function deleteClient($request,$response,$args) {
	$id = $args['id'];
	// Suppression
	// ...
	return $response->write ("");
}

// Start app
$app->run();