<?php

use Btinet\Rpg\Config\Config;
use Btinet\Rpg\Engine\TerminalEngine;
use Btinet\Rpg\View\CharacterStatsView;

require 'vendor/autoload.php';

// Terminal-Anwendung erzeugen
$app = new TerminalEngine(Config::new());

// Startansicht laden
$app->renderView(CharacterStatsView::class);