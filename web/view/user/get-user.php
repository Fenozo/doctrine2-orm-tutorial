<?php
# get-user.php 


$entityManager  = require_once join(DIRECTORY_SEPARATOR,[__DIR__,'..','..','..','config','bootstrap.php']);

use Tuto\Entity\User;

//$user =  $entityManager->find(User::class, 1);

$userRepo = $entityManager->getRepository(User::class);

//$user = $userRepo->find(1);
//echo get_class($user->getAddress());


$user = $userRepo->findAll();
echo "<pre>";
print_r($user);