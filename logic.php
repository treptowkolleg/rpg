<?php

use Btinet\Rpg\Character\Character;
use Btinet\Rpg\Character\PlayerPosition;
use Btinet\Rpg\Character\UserCharacterFactory;
use Btinet\Rpg\Engine\GameEngine;
use Btinet\Rpg\System\BackgroundColor;
use Btinet\Rpg\System\Out;
use Btinet\Rpg\System\TextColor;

require 'vendor/autoload.php';

$testChar = new Character("Ben",50,120,10,1,10,1,1,0);

Out::printHeading("Stats des aktuellen Spielers", color: TextColor::lightBlue);

Out::printListLn("Spieler",$testChar, color: TextColor::lightBlue);
Out::printListLn("Benötigte EXP","Level", color: TextColor::blue);
for($i = 1; $i <= 40; $i++) {
    $testChar->setExp(exp($i));
    Out::printListLn("EXP: {$testChar->getExp()}",$testChar->getLevel(), color: TextColor::lightBlue);
}


Out::printLn("");

Out::printListLn("HP",$testChar->getHp(), color: TextColor::lightBlue);
Out::printListLn("Attack",$testChar->getAp(), color: TextColor::green);
Out::printListLn("Defense",$testChar->getDp(), color: TextColor::red);
Out::printListLn("Vitality",$testChar->getVp(), color: TextColor::cyan);
Out::printListLn("Mood",$testChar->getMoodPoints(), color: TextColor::purple);


//$gameEngine = new GameEngine();

//$gameEngine->addPlayer(PlayerPosition::left,UserCharacterFactory::Sigmar());
//$gameEngine->addPlayer(PlayerPosition::right,UserCharacterFactory::Archaon());

//$gameEngine->start();


