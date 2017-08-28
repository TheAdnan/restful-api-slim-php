<?php

$app->get('/api/pjesme', function($request, $response, $args){
	$query = $this->db->prepare("SELECT * FROM pjesme");
    $query->execute();
    $pjesme = $query->fetchAll();
    return $this->response->withJson($pjesme);

});

$app->get('/api/pjesme/[{id}]', function($request, $response, $args){
	$query = $this->db->prepare("SELECT * FROM pjesme WHERE id=:id");
    $query->bindParam("id", $args['id']);
    $query->execute();
    $pjesme = $query->fetchObject();
    return $this->response->withJson($pjesme);
});
