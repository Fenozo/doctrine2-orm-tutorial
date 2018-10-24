<?php
# create-user.php 

$entityManager  = require_once join(DIRECTORY_SEPARATOR,[__DIR__,'..','..','..','config','bootstrap.php']);

use Tuto\Entity\User;


// Instanciation de l'utilisateur

$admin = new User();
$admin->setFirstname("Test");
$admin->setLastname("admin 2 ");
$admin->setRole("admin");

// Gestion de la persistance
$entityManager->persist($admin);
$entityManager->flush();


//vérification du résultats
echo "Identifiant de l'utilisateur créé : ", $admin->getId();

