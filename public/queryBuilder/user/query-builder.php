<?php
# query-builder.php
$entityManager  = require_once join(DIRECTORY_SEPARATOR,[__DIR__,'..','..','..','config','bootstrap.php']);


use Tuto\Entity\User;


$userRepo = $entityManager->getRepository(User::class);

$queryBuilder = $entityManager->createQueryBuilder();

$queryBuilder->select('u')
   ->from(User::class, 'u')
   ->where('u.firstname = :firstname')
   ->setParameter('firstname', 'First');

$query = $queryBuilder->getQuery();

echo $query->getDQL(), "\n";
echo $query->getOneOrNullResult();

// https://www.youtube.com/watch?v=w1FviidvxJc