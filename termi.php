<?php

use Btinet\Rpg\Config\Config;
use Btinet\Rpg\Engine\SimpleTerminalEngine;
use Btinet\Rpg\TerminalMenu\TerminalMenu;
use Btinet\Rpg\TerminalMenu\View\BattleMenuView;
use Btinet\Rpg\TerminalMenu\View\EnemySelectMenuView;
use Btinet\Rpg\TerminalMenu\View\EquipMenuView;

require "vendor/autoload.php";

const save_dir = __DIR__. DIRECTORY_SEPARATOR . "savegame" . DIRECTORY_SEPARATOR;
const log_dir = __DIR__. DIRECTORY_SEPARATOR . "log" . DIRECTORY_SEPARATOR;
const asset_dir = __DIR__. DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR;

/*
 * Engine zur Verwaltung aller Entitäten
 */
$app = new SimpleTerminalEngine(Config::new());
$app->setCurrentCharacter(0);
$app->setCurrentMonster(0);

// Eine View enthält die komplette Konfiguration einer Ansicht. Hier zum Beispiel das Kampfmenü.
$battleView = new BattleMenuView("Kampf", "k", $app);
$equipView = new EquipMenuView("Ausrüstung", "e", $app);
$enemySelectView = new EnemySelectMenuView("Gegnerdatenbank", "g", $app);

// Hauptmenü ausführen
$mainMenu = new TerminalMenu(
    "Hauptmenü",
    "a",
    null,
    $battleView->getMenu(),
    $equipView->getMenu(),
    $enemySelectView->getMenu()
);

$mainMenu->render();