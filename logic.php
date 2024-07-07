<?php

use Btinet\Rpg\Character\UserCharacterFactory;

require 'vendor/autoload.php';

$p1 = UserCharacterFactory::Archaon();
$p2 = UserCharacterFactory::Sigmar();

echo "\n\e[39m######################\n";
echo "\e[39m# Das Spiel beginnt! #\n";
echo "\e[39m######################\n\n";

while(true) {
    if($p1->getHp() <= 0) {
        break;
    } else {
        echo "\e[39m";
        echo "\n";
        echo "Befehle\n";
        echo "------------\n";
        echo "Angriff (Enter)\n";
        echo "Warten\n";
        echo "Heilen ({$p1->getPotionsCount()} Potions)\n";
        echo "============\n";
        $name = readline("$p1: \n");
        echo shell_exec('clear');
        echo "\n";
        switch (strtolower($name)) {
            case "warten":
                echo "$p1 wartet.\n";
                break;
            case "heilen":
                $p1->heal($p1);
                break;
            case "angriff":
            default:
                $p1->attack($p2);
        }
    }

    if($p2->getHp() <= 0) {
        break;
    } else {
        echo "\e[39m";
        echo "\n";
        echo "Befehle\n";
        echo "------------\n";
        echo "Angriff (Enter)\n";
        echo "Warten\n";
        echo "Heilen ({$p2->getPotionsCount()} Potions)\n";
        echo "============\n";
        $name = readline("$p2: \n");
        echo shell_exec('clear');
        echo "\n";
        switch (strtolower($name)) {
            case "warten":
                echo "$p2 wartet.\n";
                break;
            case "heilen":
                $p2->heal($p2);
                break;
            case "angriff":
            default:
                $p2->attack($p1);
        }
    }

}

echo "\e[39mDas Spiel ist zu ende!\n";


