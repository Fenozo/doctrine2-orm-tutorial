<?php

// cli-config.php
require_once join(DIRECTORY_SEPARATOR, [__DIR__,'bootstrap.php']);

use Doctrine\ORM\Tools\Console\ConsoleRunner;

$helperSet = ConsoleRunner::createHelperSet($entityManager);

return $helperSet;
