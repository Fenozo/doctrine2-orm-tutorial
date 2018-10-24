<?php
# set-user-address.php 

$entityManager  = require_once join(DIRECTORY_SEPARATOR,[__DIR__,'..','..','..','config','bootstrap.php']);

use Tuto\Entity\User;
use Tuto\Entity\Address;

$userRepo = $entityManager->getRepository(User::class);


$user = $userRepo->find(1);

$address = new Address();
$address->setStreet("Champ de Mars, 5 Avenue Anatole");
$address->setCity("Paris");
$address->setCountry("France");

$user->setAddress($address);

$entityManager->flush();

