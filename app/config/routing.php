<?php 
$pageDir = __DIR__."/../pages/";

use Symfony\Component\Routing\Route;

$routes->add('bonjour', new Route('/bonjour/{name}'), array('name' => 'inconnu'));
$routes->add('aurevoir', new Route('/arrivederci/{name}'), array('name' => 'inconnu'));
$routes->add('profil', new Route('/profil/{username}'), array('username' => 'inconnu'));

// $map = array(
//   "/bonjour" => "bonjour",
//   "/aurevoir" => "aurevoir",
//   "/profil/{username}" => "profil"
// );

