<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CertificazioniController
{
  public function index(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("SELECT * FROM certificazioni WHERE alunno_id = ".$args["id"]);
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function show(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("SELECT * FROM certificazioni WHERE alunno_id = ".$args["id"]." AND id = ".$args["idCert"]);
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function create(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $postData = $request->getParsedBody();
    $result = $mysqli_connection->query("INSERT INTO certificazioni(alunno_id, titolo, votazione, ente) VALUES 
    ('"
    .$args["id"]."', '"
    .$postData['titolo']."', '"
    .$postData['votazione']."', '"
    .$postData['ente']."')");

    $response->getBody()->write(json_encode("ok"));
    return $response->withHeader("Content-type", "application/json")->withStatus(201);
  }

  public function update(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $postData = $request->getParsedBody();
    $result = $mysqli_connection->query("UPDATE certificazioni SET 
    alunno_id = '".$postData['alunno_id']."', 
    titolo = '".$postData['titolo']."', 
    votazione = '".$postData['votazione']."', 
    ente = '". $postData['ente']."' 
    WHERE id = ".$args["idCert"]."");

    $response->getBody()->write(json_encode("ok"));
    return $response->withHeader("Content-type", "application/json")->withStatus(201);
  }

  public function destroy(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("DELETE FROM certificazioni WHERE id = '".$args["idCert"]."'");

    $response->getBody()->write(json_encode("ok"));
    return $response->withHeader("Content-type", "application/json")->withStatus(201);
  }
}
