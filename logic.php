<?php

use Btinet\Rpg\Character;

require 'vendor/autoload.php';


$gladiator = new Character('Alexander');
$monster = new Character('Org',120,4,1,3);
echo "\e[39m######################\n";
echo "\e[39m# Das Spiel beginnt! #\n";
echo "\e[39m######################\n\n";

while(true) {

    if($gladiator->getHp() <= 0) {
        break;
    } else {
        $gladiator->attack($monster);
    }

    if($monster->getHp() <= 0) {
        break;
    } else {
        $monster->attack($gladiator);
    }

}

echo "\e[39mDas Spiel ist zu ende!\n";


