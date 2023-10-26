<?php
use Monolog\Logger;

return[
    'log.name' => 'auth.log',
    'log.file' => __DIR__.'/../../src/console/auth.log',
    'log.level' => Logger::WARNING,
];
