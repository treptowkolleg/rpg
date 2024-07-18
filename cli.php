<?php

use Btinet\Rpg\Config\Config;
use Btinet\Rpg\Engine\FileEngine;
use Btinet\Rpg\Engine\LoggerEngine;
use Btinet\Rpg\Engine\TerminalEngine;
use Btinet\Rpg\System\BackgroundColor;
use Btinet\Rpg\System\Out;
use Btinet\Rpg\View\CharacterStatsView;

require 'vendor/autoload.php';

const save_dir = __DIR__. DIRECTORY_SEPARATOR . "savegame" . DIRECTORY_SEPARATOR;
const log_dir = __DIR__. DIRECTORY_SEPARATOR . "log" . DIRECTORY_SEPARATOR;

$app = null;
// Terminal-Anwendung laden oder neu erzeugen
try {
    $object = FileEngine::loadGame();
    if($object instanceof TerminalEngine) {
        $app = $object;
        Out::printAlert("Letzten Stand geladen",background: BackgroundColor::green);
    } else {
        $app = new TerminalEngine(Config::new());
        Out::printAlert("Neues Spiel gestartet",background: BackgroundColor::blue);
    }
} catch (Exception $exception) {
    Out::printAlert($exception->getMessage());
}
$app->attach(new LoggerEngine(log_dir. "log.csv"));
// Startansicht laden
$app?->renderView(CharacterStatsView::class);

