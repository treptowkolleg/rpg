<?php

declare(strict_types=1);

use Btinet\Rpg\Config\Config;
use Btinet\Rpg\Engine\FileEngine;
use Btinet\Rpg\Engine\LoggerEngine;
use Btinet\Rpg\Engine\TerminalEngine;
use Btinet\Rpg\System\BackgroundColor;
use Btinet\Rpg\System\Out;
use Btinet\Rpg\System\TextColor;
use Btinet\Rpg\TerminalMenu\TerminalMenu;
use Btinet\Rpg\View\CharacterStatsView;

require 'vendor/autoload.php';

const save_dir = __DIR__. DIRECTORY_SEPARATOR . "savegame" . DIRECTORY_SEPARATOR;
const log_dir = __DIR__. DIRECTORY_SEPARATOR . "log" . DIRECTORY_SEPARATOR;
const asset_dir = __DIR__. DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR;

$app = null;
// Terminal-Anwendung laden oder neu erzeugen
try {
    $object = FileEngine::loadGame();
    if($object instanceof TerminalEngine) {
        $app = $object;
        Out::printAlert("Spielstand wird geladen...", TextColor::lightGreen, BackgroundColor::black);
    } else {
        $app = new TerminalEngine(Config::new());
        Out::printAlert("Neues Spiel wird gestartet...", TextColor::lightBlue,BackgroundColor::black);
    }
    sleep(2);
} catch (Exception $exception) {
    Out::printAlert($exception->getMessage());
}
$app->attach(new LoggerEngine(log_dir. "log.csv"));
// Startansicht laden
//$app?->renderView(CharacterStatsView::class);


