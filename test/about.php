<?php

require_once __DIR__ . '/../vendor/autoload.php';

use HoraceHo\Ers;

$ers = new Ers\Ers();
echo $ers->about() . PHP_EOL;
