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


$app->post('/api/pjesme', function ($request, $response) {
    $input = $request->getParsedBody();
    $sql = "INSERT INTO pjesme (url) VALUES (:url)";
    $query = $this->db->prepare($sql);
    $query->bindParam("url", $input['url']);
    //add other
    $query->execute();
    $input['id'] = $this->db->lastInsertId();
    return $this->response->withJson($input);
});
    

$app->delete('/api/pjesme/[{id}]', function ($request, $response, $args) {
    $query = $this->db->prepare("DELETE FROM pjesme WHERE id=:id");
    $query->bindParam("id", $args['id']);
    $query->execute();
    $pjesme = $query->fetchAll();
    return $this->response->withJson($pjesme);
});

$app->put('/api/pjesme/[{id}]', function ($request, $response, $args) {
    $input = $request->getParsedBody();
    $sql = "UPDATE pjesme SET url=:url WHERE id=:id";
    $query = $this->db->prepare($sql);
    $query->bindParam("id", $args['id']);
    $query->bindParam("url", $input['url']);
    $query->execute();
    $input['id'] = $args['id'];
    return $this->response->withJson($input);
});
