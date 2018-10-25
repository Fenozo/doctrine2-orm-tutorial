<?php
# create-participation.php

$entityManager = require_once join(DIRECTORY_SEPARATOR, [__DIR__,"..","..","..","config", 'bootstrap.php']);

use Tuto\Entity\Participation;
use Tuto\Entity\Poll;
use Tuto\Entity\User;

$participation = new Participation();

$participation->setDate(new \Datetime("2017-03-03T09:00:00Z"));

$pollRepo = $entityManager->getRepository(Poll::class);
$poll = $pollRepo->find(4);

$userRepo = $entityManager->getRepository(User::class);
$user = $userRepo->find(1);

$participation->setUser($user);
$participation->setPoll($poll);

$entityManager->persist($participation);
$entityManager->flush();


exit;
