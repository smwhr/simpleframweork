<?php 
$pageDir = __DIR__."/../pages/";

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

$routes->add('bonjour', 
  new Route('/bonjour/{name}', 
    array('name' => 'inconnu', 
          '_controller' => function($request) use ($generator){
              $name = $request->attributes->get('name');
              $request->attributes->set(
                    'sname', 
                    htmlspecialchars($name)
              );
              $request->attributes->set(
                    'aurevoirlink', 
                    $generator->generate('aurevoir', ["name" => $name])
              );

              return render_template($request);
          }
    )
  )
);
$routes->add('aurevoir', new Route('/arrivederci/{name}'), array('name' => 'inconnu'));
$routes->add('profil', new Route('/profil/{username}'), array('username' => 'inconnu'));