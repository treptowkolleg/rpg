<?php

namespace Btinet\Rpg\Character;

use Btinet\Rpg\Item\Potion;

class UserCharacter extends AbstractCharacter
{

    private array $potions;

    public function __construct(string $name, int $hp, int $ap, float $attackFactor, int $dp, float $defenseFactor)
    {
        $this->potions = [
            new Potion(),
            new Potion(),
            new Potion(),
        ];

        parent::__construct($name, $hp, $ap, $attackFactor, $dp, $defenseFactor);
    }

    public function heal(UserCharacter $p1)
    {
        if(count($this->potions) > 0) {
            $usedPotion = array_shift($this->potions);
            $this->addHp($usedPotion->getHp());
            echo "\e[39m♡ $this um {$usedPotion->getHp()}HP geheilt.\n";
            echo "\e[93m♡ $this hat nun {$this->getHp()}/{$this->getMaxHP()} HP!\n\n";
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