<?php

use Btinet\Rpg\TerminalMenu\TerminalMenu;

require "vendor/autoload.php";

$mainMenu = new TerminalMenu("Hauptmenü","main");
$battleMenu = new TerminalMenu("Kampfmenü","kampf");

$mainMenu->addChild($battleMenu);

$mainMenu->doAction();