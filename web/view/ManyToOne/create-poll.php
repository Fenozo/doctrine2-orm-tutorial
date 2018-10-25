<?php
# create-poll.php

$entityManager  = require_once join(DIRECTORY_SEPARATOR,[__DIR__,'..','..','..','config','bootstrap.php']);

use Tuto\Entity\Poll;
use Tuto\Entity\Question;
use Tuto\Entity\Answer;

$poll = new Poll();

$poll->setTitle("Doctrine 2, ça vous dit ?");
$poll->setCreated(new \Datetime("2017-03-03T08:00:00Z"));

# Question 1
$questionOne = new Question();
$questionOne->setWording("Doctrine 2 est-il un bon ORM ?");

$yes = new Answer();
$yes->setWording("Oui, bien sûr !");
$questionOne->addAnswer($yes);

$no = new Answer();
$no->setWording("Non, peut mieux faire.");
$questionOne->addAnswer($no);

# Ajout de la question au sondage
$poll->addQuestion($questionOne);


# Question 2
$questionTwo = new Question();
$questionTwo->setWording("Doctrine 2 est-il facile d'utilisation ?");

$yesDoc = new Answer();
$yesDoc->setWording("Oui, il y a une bonne documentation !");
$questionTwo->addAnswer($yesDoc);

$yesTuto = new Answer();
$yesTuto->setWording("Oui, il y a de bons tutoriels !");
$questionTwo->addAnswer($yesTuto);

$no = new Answer();
$no->setWording("Non.");
$questionTwo->addAnswer($no);

# Ajout de la question au sondage
$poll->addQuestion($questionTwo);


$entityManager->persist($questionOne);
$entityManager->persist($questionTwo);
$entityManager->persist($poll);

$entityManager->flush();

echo $poll;