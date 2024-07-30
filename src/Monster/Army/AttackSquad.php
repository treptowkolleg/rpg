<?php

namespace Btinet\Rpg\Monster\Army;

use Btinet\Rpg\Ability\Grenade;
use Btinet\Rpg\Ability\MachineGun;
use Btinet\Rpg\Ability\SmokeBullet;
use Btinet\Rpg\Character\Character;
use Btinet\Rpg\Item\Item;
use Btinet\Rpg\Monster\Monster;

class AttackSquad extends Monster
{
    private int $counter = 0;


    /**
     * AI einrichten
     */
    public function setup(): void
    {
        $this->abilities = [
          new MachineGun(),
          new Grenade(),
          new SmokeBullet(),
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

    public function apply(Item $item, Character|Monster $entity): void
    {
        // TODO: Implement apply() method.
    }

    public function defend(): void
    {
        // TODO: Implement defend() method.
    }

}
