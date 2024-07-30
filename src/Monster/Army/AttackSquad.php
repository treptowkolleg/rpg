<?php

namespace Btinet\Rpg\Monster\Army;


use Btinet\Rpg\Character\Character;
use Btinet\Rpg\Monster\Monster;
use Btinet\Rpg\Monster\MonsterAI;

class AttackSquad extends Monster implements MonsterAI
{

    // TODO: Eigene Ability-Klasse implementieren (ähnlich wie Waffen)
    private array $abilities = [];

    private int $counter = 0;

    /**
     * AI einrichten
     */
    public function setup(): void
    {
        $this->abilities = [
          "Maschinengewehr",
          "Granate",
          "Rauchbombe",
        ];
    }

    /**
     * Normaler Angriff
     */
    public function main(Character|Monster $target): void
    {
        $randomInt = time() % count($this->abilities);
        $this->setCurrentAttack($this->abilities[$randomInt]);
        $this->attack($target);
    }

    /**
     * Gegenangriff
     */
    public function counter(Character|Monster $target): void
    {
        if($this->getHp() <= 1/3 * $this->getHp()) {
            if($this->counter == 0) {
                $this->setCurrentAttack($this->abilities[2]);
                $this->attack($target);
                $this->counter = 1;
            } else {
                $this->counter = 0;
            }
        }
    }

}
