<?php
use Monolog\Logger;

return[
    'log.name' => 'catalogue.log',
    'log.file' => __DIR__.'/../../src/console/catalogue.log',
    'log.level' => Logger::WARNING,
];