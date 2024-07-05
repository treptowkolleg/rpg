<?php

use Btinet\Rpg\Character;

require 'vendor/autoload.php';


$gladiator = new Character('Alexander');
$monster = new Character('Org',120,4,1,3);

echo "Das Spiel beginnt!\n";

while(true) {
    $gladiator->attack($monster);
    $monster->attack($gladiator);
    if($gladiator->getHp() <= 0) {
        echo "$gladiator ist tot!\n";
        break;
    }
    if($monster->getHp() <= 0) {
        echo "$monster ist tot!\n";
        break;
    }
}

echo "Das Spiel ist zu ende!\n";


