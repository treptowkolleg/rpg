<?php

namespace Btinet\Rpg\Engine;

use Btinet\Rpg\Character\AbstractCharacter;
use Btinet\Rpg\Character\PlayerPosition;
use Btinet\Rpg\Character\UserCharacter;
use Btinet\Rpg\System\BackgroundColor;
use Btinet\Rpg\System\Out;
use Btinet\Rpg\System\TextColor;

class GameEngine
{

    public int $runde = 0;
    private array $player;

    public function __construct()
    {

    }

    public function start(): void
    {
        Out::printHeading("Das Spiel beginnt!", TextColor::lightBlue);

        while(true) {
            $partyHP = 0;
            foreach ($this->player as $parties) {
                $partyHP = 0;
                foreach ($parties as $player) {
                    /** @var AbstractCharacter $player */
                    $partyHP += $player->getHp();
                    if($player->getHp() > 0) {
                        $this->makeTurn($player);
                    }
                }
                if($partyHP <= 0) break 2;
            }
        }

        Out::printHeading("Das Spiel ist zu Ende!",TextColor::lightBlue);
    }

    public function addPlayer(PlayerPosition $position, UserCharacter $character): GameEngine
    {
        $this->player[$position->name][] = $character;
        return $this;
    }


    public function makeTurn(AbstractCharacter $character): bool
    {
        $this->runde++;
        echo "\e[39m";
        echo "\n";
        echo "Runde {$this->runde}\n\n";
       if(in_array($character,$this->player[PlayerPosition::left->name])) {
           $targetPosition = PlayerPosition::right;
       } else {
           $targetPosition = PlayerPosition::left;
       }

       $character->makePoisonDamage();


        if($character instanceof UserCharacter) {
            echo "\e[39m";
            echo "\n";

            echo "Befehle\n";
            echo "------------\n";
            echo "Angriff (Enter)\n";
            echo "Warten\n";
            echo "Heilen ({$character->getPotionsCount()} Potions)\n";
            echo "============\n";
            $name = readline("{$character}: \n");
            echo "\n";

            switch (strtolower($name)) {

                case "warten":
                    echo "{$character} wartet.\n";
                    echo "Ziele\n";
                    echo "------------\n";
                    for($i = 0; $i < count($this->player[$targetPosition->name]); $i++) {
                        $targetPlayer = $this->player[$targetPosition->name][$i];
                        echo "$i: $targetPlayer\n";
                    }
                    echo "============\n";
                    echo "\n\n";

                    while(true) {
                        $targetIndex = readline("Gift auf: \n");
                        $targetIndex = intval($targetIndex);
                        if($targetIndex >= 0 and $targetIndex < count($this->player[$targetPosition->name])) {
                            break;
                        } else {
                            echo "Gib nur die Nummer des Gegners ein!\n";
                        }
                    }

                    echo shell_exec('clear');
                    $target = $this->player[$targetPosition->name][$targetIndex];
                    $target->setPoison(3);

                    break;

                case "heilen":
                    $character->heal($character);
                    break;

                case "angriff":
                default:
                    echo "Ziele\n";
                    echo "------------\n";
                    for($i = 0; $i < count($this->player[$targetPosition->name]); $i++) {
                        $targetPlayer = $this->player[$targetPosition->name][$i];
                        echo "$i: $targetPlayer\n";
                    }
                    echo "============\n";
                    echo "\n\n";

                    while(true) {
                        $targetIndex = readline("Angriff auf: \n");
                        $targetIndex = intval($targetIndex);
                        if($targetIndex >= 0 and $targetIndex < count($this->player[$targetPosition->name])) {
                            break;
                        } else {
                            echo "Gib nur die Nummer des Gegners ein!\n";
                        }
                    }

                    echo shell_exec('clear');
                    $target = $this->player[$targetPosition->name][$targetIndex];
                    $character->attack($target);
            }
        }
        return true;
    }

}