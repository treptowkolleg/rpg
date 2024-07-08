<?php

namespace Btinet\Rpg\Engine;

use ArrayObject;
use Btinet\Rpg\Character\PlayerPosition;
use Btinet\Rpg\Character\UserCharacter;

class GameEngine
{

    private ArrayObject $player;

    public function __construct()
    {
        $this->player = new ArrayObject();
    }

    public function start(): void
    {
        echo "\n\e[39m######################\n";
        echo "\e[39m# Das Spiel beginnt! #\n";
        echo "\e[39m######################\n\n";

        while(true) {

            // TODO: Jeder Spieler soll Ziel manuell wählen können.
            //
            $p1 = $this->makeTurn(PlayerPosition::one,PlayerPosition::two);
            if(!$p1) break;
            $p2 = $this->makeTurn(PlayerPosition::two,PlayerPosition::one);
            if(!$p2) break;
        }

        echo "\e[39mDas Spiel ist zu ende!\n";
    }

    public function addPlayer(PlayerPosition $position, UserCharacter $character): GameEngine
    {
        $this->player->offsetSet($position->value, $character);
        return $this;
    }

    public function getPlayer(PlayerPosition $position): ?UserCharacter
    {
        return $this->player->offsetGet($position->value) ?? null;
    }

    public function makeTurn(PlayerPosition $origin, PlayerPosition $target): bool
    {
        if($this->getPlayer($origin)->getHp() <= 0) {
            return false;
        } else {
            echo "\e[39m";
            echo "\n";

            // TODO: Zuerst Ziel wählen und dann den Befehl

            echo "Befehle\n";
            echo "------------\n";
            echo "Angriff (Enter)\n";
            echo "Warten\n";
            echo "Heilen ({$this->getPlayer($origin)->getPotionsCount()} Potions)\n";
            echo "============\n";
            $name = readline("{$this->getPlayer($origin)}: \n");
            echo shell_exec('clear');
            echo "\n";
            switch (strtolower($name)) {
                case "warten":
                    echo "{$this->getPlayer($origin)} wartet.\n";
                    break;
                case "heilen":
                    $this->getPlayer($origin)->heal($this->getPlayer($origin));
                    break;
                case "angriff":
                default:
                $this->getPlayer($origin)->attack($this->getPlayer($target));
            }
        }
        return true;
    }

}