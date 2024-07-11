<?php

namespace Btinet\Rpg\Character;

use Btinet\Rpg\Item\Potion;

class UserCharacter extends AbstractCharacter
{

    public array $potions;

    public function __construct(string $name, int $hp, int $ap, float $attackFactor, int $dp, float $defenseFactor, array $potions)
    {
        $this->potions = $potions;

        parent::__construct($name, $hp, $ap, $attackFactor, $dp, $defenseFactor);
    }

    public function heal(UserCharacter $character = null)
    {
        if(!$character) $character = $this;

        if(count($this->potions) > 0) {
            $usedPotion = array_shift($character->potions);
            $character->addHp($usedPotion->getHp());
            echo "\e[39m♡ $character um {$usedPotion->getHp()}HP geheilt.\n";
            echo "\e[93m♡ $character hat nun {$character->getHp()}/{$character->getMaxHP()} HP!\n\n";
        } else {
            echo "\e[39mKeine Potions mehr verfügbar!\n";
        }
    }

    public function getPotionsCount(): int
    {
        return count($this->potions);
    }

    private function addHp(int $hp)
    {
        $this->hp += $hp;
    }

}