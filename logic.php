<?php

use Btinet\Rpg\Character\PlayerPosition;
use Btinet\Rpg\Character\UserCharacterFactory;
use Btinet\Rpg\Engine\GameEngine;

require 'vendor/autoload.php';

$gameEngine = new GameEngine();

$gameEngine->addPlayer(PlayerPosition::one, UserCharacterFactory::Archaon());
$gameEngine->addPlayer(PlayerPosition::two, UserCharacterFactory::Sigmar());

$gameEngine->start();


