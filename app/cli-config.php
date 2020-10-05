<?php

use App\Core\Application;
use App\Core\DataManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

require __DIR__.'/vendor/autoload.php';

$config = require __DIR__.'/config/main.php';
$application = (new Application($config));

return ConsoleRunner::createHelperSet($application->getContainer()->get(DataManager::class)->getEntityManager());
