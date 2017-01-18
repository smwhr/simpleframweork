<?php

require_once(__DIR__."/../vendor/autoload.php");

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Generator\UrlGenerator;

$request = Request::createFromGlobals();


$routes = new RouteCollection();
include (__DIR__."/../app/config/routing.php");

$context = new RequestContext();
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);
$generator = new UrlGenerator($routes, $context);

function render_template($request){
  global $pageDir, $generator;
  ob_start();
  extract($request->attributes->all(), EXTR_SKIP);
  include sprintf($pageDir. "%s.php", $_route );
  return new Response(ob_get_clean());
};

try{
  $request->attributes->add($matcher->match($request->getPathInfo()));

  var_dump($request->attributes->all());

  $response = call_user_func($request->attributes->get('_controller'), $request);

}catch(ResourceNotFoundException $e){
  $response->setStatusCode(404);
  $response->setContent("Oops nothing here !");
}catch(Exception $e){
  $response->setStatusCode(500);
  $response->setContent("Déso c'est cassé :/");
}

$response->send();
