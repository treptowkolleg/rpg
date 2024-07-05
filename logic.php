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
        $p1->attack($p2);
    }

    if($p2->getHp() <= 0) {
        break;
    } else {
        $p2->attack($p1);
    }

}

echo "\e[39mDas Spiel ist zu ende!\n";


