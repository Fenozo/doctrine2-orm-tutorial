<?php
# create-user.php 

$entityManager  = require_once join(DIRECTORY_SEPARATOR,[__DIR__,'..','..','..','config','bootstrap.php']);

use App\Entity\User;

$identifiant =3;

$userRepo = $entityManager->getRepository(User::class);

// Récuperation de l'utilisateur
$user = $userRepo->find($identifiant);

$entityManager->remove($user);
$entityManager->flush($user);

// Récupération pour vérifier la suppression effective de l'utilisateur
$user = $userRepo->find($identifiant);

//var_dump($user); // doit renvoyer NULL