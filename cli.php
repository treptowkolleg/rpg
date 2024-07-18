<?php

use Btinet\Rpg\Config\Config;
use Btinet\Rpg\Engine\TerminalEngine;
use Btinet\Rpg\System\BackgroundColor;
use Btinet\Rpg\System\Out;
use Btinet\Rpg\View\CharacterStatsView;

require 'vendor/autoload.php';

// Terminal-Anwendung erzeugen
$app = new TerminalEngine(Config::new());
$cloud = serialize($app->getCharacter(0));
file_put_contents("save.txt",$cloud);
Out::printAlert("Char Stats gespeichert!",background: BackgroundColor::green);
// Spiel speichern
try {
    $cloudData = file_get_contents("save.txt");
    $char = unserialize($cloudData);
    $app->addCharacter($char);
} catch (Exception $e) {
} finally {
    Out::printAlert("Char Stats geladen!",background: BackgroundColor::blue);
}



// Startansicht laden
$app->renderView(CharacterStatsView::class);

