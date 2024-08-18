<?php

use Btinet\Rpg\Config\Config;
use Btinet\Rpg\Engine\SimpleTerminalEngine;

require "vendor/autoload.php";

const save_dir = __DIR__. DIRECTORY_SEPARATOR . "savegame" . DIRECTORY_SEPARATOR;
const log_dir = __DIR__. DIRECTORY_SEPARATOR . "log" . DIRECTORY_SEPARATOR;
const asset_dir = __DIR__. DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR;

/*
 * Engine zur Verwaltung aller Entitäten
 */
$app = new SimpleTerminalEngine(Config::new(), "Hauptmenü", "m");
$app->setCurrentCharacter(0);
$app->setCurrentMonster(0);

$app->start();