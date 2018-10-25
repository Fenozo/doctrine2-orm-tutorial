<?php
# create-question.php

$entityManager  = require_once join(DIRECTORY_SEPARATOR,[__DIR__,'..','..','..','config','bootstrap.php']);

use Tuto\Entity\Question;
use Tuto\Entity\Answer;

$question = new Question();

$question->setWording("Doctrine 2 est-il un bon ORM ?");

$yes = new Answer();
$yes->setWording("Oui, bien sûr !");

$question->addAnswer($yes);

$no = new Answer();
$no->setWording("Non, peut mieux faire.");

$question->addAnswer($no);

$entityManager->persist($question);
$entityManager->flush();

echo $question;