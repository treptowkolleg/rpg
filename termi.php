<?php

use Btinet\Rpg\Config\Config;
use Btinet\Rpg\Engine\SimpleTerminalEngine;
use Btinet\Rpg\System\Out;
use Btinet\Rpg\TerminalMenu\TerminalMenu;
use Btinet\Rpg\TerminalMenu\TerminalMenuItem;
use Btinet\Rpg\TerminalMenu\View\BattleMenuView;

require "vendor/autoload.php";

const save_dir = __DIR__. DIRECTORY_SEPARATOR . "savegame" . DIRECTORY_SEPARATOR;
const log_dir = __DIR__. DIRECTORY_SEPARATOR . "log" . DIRECTORY_SEPARATOR;
const asset_dir = __DIR__. DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR;


/*
 * Engine zur Verwaltung aller Entitäten
 */
$app = new SimpleTerminalEngine(Config::new());
$app->setCurrentCharacter(1);
$app->setCurrentMonster(4);

// Eine View enthält die komplette Konfiguration einer Ansicht. Hier zum Beispiel das Kampfmenü.
$battleView = new BattleMenuView($app);

// Monster-Auswahlmenü
$enemySelectMenu = new TerminalMenu("Gegnerdatenbank","g");

// Alle verfügbaren Monster zur Auswahl hinzufügen und Aktion zur Selektion implementieren.
foreach ($app->getMonsterList() as $key => $monster) {
    $monsterItem = new TerminalMenuItem("{$monster->getLabel()}","$key");
    $monsterItem->addAction(function() use($app, $key, $monster, $enemySelectMenu) {
        $app->setCurrentMonster($key);
        Out::print("{$monster->getLabel()}");
        Out::printLn(" wurde ausgewählt.");
        sleep(2);
        $enemySelectMenu->getParentMenu()->render();
    });
    $enemySelectMenu->addChildren($monsterItem);
}

// Ausrüstungsmenü
$weaponEquipMenuItem = new TerminalMenuItem("Waffen","1");
$gearEquipMenuItem = new TerminalMenuItem("Rüstung","2");
$equipMenu = new TerminalMenu("Ausrüstung","e");
$equipMenu->addChildren($weaponEquipMenuItem, $gearEquipMenuItem);


// Hauptmenü ausführen
$mainMenu = new TerminalMenu(
    "Hauptmenü",
    "a",
    null,
    $battleView->getMenu(),
    $equipMenu,
    $enemySelectMenu
);

$mainMenu->render();