<?php

use Btinet\Rpg\Character\PlayerPosition;
use Btinet\Rpg\Character\UserCharacterFactory;
use Btinet\Rpg\Engine\GameEngine;

require 'vendor/autoload.php';

$gameEngine = new GameEngine();

$gameEngine->addPlayer(PlayerPosition::left,UserCharacterFactory::Sigmar());
$gameEngine->addPlayer(PlayerPosition::right,UserCharacterFactory::Archaon());

$gameEngine->start();


