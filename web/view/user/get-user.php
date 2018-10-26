<?php
# get-user.php 


$entityManager  = require_once join(DIRECTORY_SEPARATOR,[__DIR__,'..','..','..','config','bootstrap.php']);

use App\Entity\User;





//$user =  $entityManager->find(User::class, 1);

$userRepo = $entityManager->getRepository(User::class);

    //$user = $userRepo->find(1);
    //echo get_class($user->getAddress());
    //$userRepo->test();


use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

use App\Controller\DefaultController;



$routes = new RouteCollection();

$routes->add('route_name', 
    new Route('/foo', 
        array(
            '_controller' => [DefaultController::class, 'index']
        )));


$context = new RequestContext('/');

$matcher = new UrlMatcher($routes, $context);

$parameters = $matcher->match('/foo');








exit;
$user = $userRepo->findAll();
echo "<pre>";
//print_r($user);

