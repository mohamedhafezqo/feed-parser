<?php

use Symfony\Component\Dotenv\Dotenv;

passthru(sprintf(
    'php "%s/../bin/console" doctrine:database:drop --force --env=test',
    __DIR__
));
passthru(sprintf(
    'php "%s/../bin/console" doctrine:database:create --no-interaction --env=test',
    __DIR__
));
passthru(sprintf(
    'php "%s/../bin/console" doctrine:schema:create --no-interaction --env=test',
    __DIR__
));
require __DIR__ . '/../config/bootstrap.php';

require dirname(__DIR__).'/vendor/autoload.php';

if (file_exists(dirname(__DIR__).'/config/bootstrap.php')) {
    require dirname(__DIR__).'/config/bootstrap.php';
} elseif (method_exists(Dotenv::class, 'bootEnv')) {
    (new Dotenv())->bootEnv(dirname(__DIR__).'/.env');
}
