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
$response  = new Response();

$routes = new RouteCollection();
include (__DIR__."/../app/config/routing.php");

$context = new RequestContext();
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);
$generator = new UrlGenerator($routes, $context);


try{
  $attributes = $matcher->match($request->getPathInfo());

  ob_start();
  extract($attributes, EXTR_SKIP);
  
  include sprintf($pageDir. "%s.php", $attributes["_route"] );

  $content = ob_get_clean();
  $response->setContent($content);
}catch(ResourceNotFoundException $e){
  $response->setStatusCode(404);
  $response->setContent("Oops nothing here !");
}catch(Exception $e){
  $response->setStatusCode(500);
  $response->setContent("Déso c'est cassé :/");
}

$response->send();
