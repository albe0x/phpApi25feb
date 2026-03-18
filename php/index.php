<?php
use Slim\Factory\AppFactory;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/controllers/AlunniController.php';
require __DIR__ . '/controllers/CertificazioniController.php';

$app = AppFactory::create();

//CHAT CONSIGLIA:
$app->addBodyParsingMiddleware(); 

$app->get('/alunni',            "AlunniController:index");
$app->get('/alunni/{id}',       "AlunniController:show");
$app->post('/alunni',           "AlunniController:create");
$app->put('/alunni/{id}',       "AlunniController:update");
$app->delete('/alunni/{id}'  ,  "AlunniController:destroy");

$app->get('/alunni/{id}/certificazioni',            "CertificazioniController:index");
$app->get('/alunni/{id}/certificazioni/{idCert}',       "CertificazioniController:show");
$app->post('/alunni/{id}/certificazioni',           "CertificazioniController:create");
$app->put('/alunni/{id}/certificazioni/{idCert}',       "CertificazioniController:update");
$app->delete('/alunni/{id}/certificazioni/{idCert}'  ,  "CertificazioniController:destroy");

$app->run();
