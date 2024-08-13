<?php

use Btinet\Rpg\Character\Predefined\Cloud;
use Btinet\Rpg\Character\Predefined\Tifa;
use Btinet\Rpg\TerminalMenu\TerminalMenu;

require "vendor/autoload.php";

const save_dir = __DIR__. DIRECTORY_SEPARATOR . "savegame" . DIRECTORY_SEPARATOR;
const log_dir = __DIR__. DIRECTORY_SEPARATOR . "log" . DIRECTORY_SEPARATOR;
const asset_dir = __DIR__. DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR;

$cloud = new Cloud();
$tifa = new Tifa();


$mainMenu = new TerminalMenu("Hauptmenü","main");
$battleMenu = new TerminalMenu("Kampfmenü","kampf");
$attackMenuItem = new TerminalMenu("Angriff","hit");

// Methode implementieren und ausführen, wenn "hit" benutzt wird.
$attackMenuItem->addAction(function() use($cloud,$tifa) {
    $cloud->attack($tifa);
});

// Untermenüs bzw. Aktionen zu Menüs hinzufügen.
$mainMenu->addChild($battleMenu);
$battleMenu->addChild($attackMenuItem);

// Hauptmenü ausführen
$mainMenu->render();