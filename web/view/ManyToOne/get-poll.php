<?php
# get-poll.php

$entityManager = require_once join(DIRECTORY_SEPARATOR, [__DIR__,"..","..","..","config", 'bootstrap.php']);

use App\Entity\Poll;

$pollRepo = $entityManager->getRepository(Poll::class);

$poll = $pollRepo->find(2);

//echo $poll;exit;

if (!empty($poll )) {
    foreach ($poll->getQuestions() as $question) {
        echo "- ", $question;
    
        foreach ($question->getAnswers() as $answer) {
            echo "-- ", $answer;
        }
    }
}