<?php

use App\Configuration\AppConfiguration;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

return ConsoleRunner::createHelperSet((new AppConfiguration())->entityManager());
