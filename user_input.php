<?php

use Btinet\Rpg\Character\UserCharacterFactory;

require 'vendor/autoload.php';

// Spieler erstellen
$p1 = UserCharacterFactory::Sigmar();
$p2 = UserCharacterFactory::Archaon();

// Auf Eingabe im Terminal warten
$input = readline("Eingabe machen: \n");

// per Switch entsprechende Aktion ausführen:
switch (strtolower($input)) {

    // Wenn "warten" eingegeben wurde (Groß-/Kleinschreibung ist egal)
    case "warten":
        echo "Spieler wartet.\n";
        break;

    // Wenn "heilen" eingegeben wurde (Groß-/Kleinschreibung ist egal)
    case "heilen":
        $p2->heal($p2);
        break;

    // Wenn nichts oder "angriff" eingegeben wurde (Groß-/Kleinschreibung ist egal)
    case "angriff":
    default:
        $p2->attack($p1);

}
