<?php

use Btinet\Rpg\Config\Config;
use Btinet\Rpg\Engine\SimpleTerminalEngine;
use Btinet\Rpg\TerminalMenu\TerminalMenu;
use Btinet\Rpg\TerminalMenu\TerminalMenuItem;

require "vendor/autoload.php";

const save_dir = __DIR__. DIRECTORY_SEPARATOR . "savegame" . DIRECTORY_SEPARATOR;
const log_dir = __DIR__. DIRECTORY_SEPARATOR . "log" . DIRECTORY_SEPARATOR;
const asset_dir = __DIR__. DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR;

/*
 * Wir sollten hier besser eine Klasse bauen, die aktuelle Charaktere etc. speichert.
 * So kann dann über das Menü ausgewählt werden, wer gerade gegen wen kämpfen soll,
 * welche Items und Ausrüstung verfügbar ist und auch ein NPC-Chat wäre so umsetzbar.
 */

/*
 * Engine zur Steuerung aller Funktionen
 */
$app = new SimpleTerminalEngine(Config::new());
$app->setCurrentCharacter(0);
$app->setCurrentMonster(4);


$attackMenuItem = new TerminalMenuItem("Angriff","1");
$defendMenuItem = new TerminalMenuItem("Verteidigen","2");
$battleMenu = new TerminalMenu("Kampf","k");
$battleMenu->addChildren($attackMenuItem, $defendMenuItem);

$weaponEquipMenuItem = new TerminalMenuItem("Waffen","1");
$gearEquipMenuItem = new TerminalMenuItem("Rüstung","2");
$equipMenu = new TerminalMenu("Ausrüstung","e");
$equipMenu->addChildren($weaponEquipMenuItem, $gearEquipMenuItem);

// Methode implementieren und ausführen, wenn "Angriff" benutzt wird.
$attackMenuItem->addAction(function() use($app) {
    $app->getCurrentCharacter()->attack($app->getCurrentMonster());
    $app->getCurrentMonster()->counter($app->getCurrentCharacter());
    $app->getCurrentMonster()->main($app->getCurrentCharacter());
    sleep(3);
});

// Methode implementieren und ausführen, wenn "Verteidigung" benutzt wird.
$defendMenuItem->addAction(function() use($app) {
    $app->getCurrentCharacter()->defend();
    sleep(2);
});

// Hauptmenü ausführen
$mainMenu = new TerminalMenu("Hauptmenü","a",null, $battleMenu, $equipMenu);
$mainMenu->render();