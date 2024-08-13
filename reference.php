<?php

use Btinet\Rpg\Character\Predefined\Cloud;
use Btinet\Rpg\Character\Predefined\Tifa;
use Btinet\Rpg\TrainingA;

require 'vendor/autoload.php';

const save_dir = __DIR__. DIRECTORY_SEPARATOR . "savegame" . DIRECTORY_SEPARATOR;
const log_dir = __DIR__. DIRECTORY_SEPARATOR . "log" . DIRECTORY_SEPARATOR;
const asset_dir = __DIR__. DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR;


$trainingClass = new TrainingA();

$myNumber = 25;

$myNewNumber = $trainingClass->modifyNormal($myNumber);

echo $myNumber . PHP_EOL;
$trainingClass->modifyByReference($myNumber);
echo $myNumber . PHP_EOL;

$cloud = new Cloud();
$tifa = new Tifa();

$trainingClass->addChars($cloud, $tifa);

echo $trainingClass->getHpFromCharAt(0) . PHP_EOL;
echo $trainingClass->getHpFromCharAt(1) . PHP_EOL;