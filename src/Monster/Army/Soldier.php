<?php

namespace Btinet\Rpg\Monster\Army;

use Btinet\Rpg\Ability\Grenade;
use Btinet\Rpg\Ability\MachineGun;
use Btinet\Rpg\Character\Character;
use Btinet\Rpg\Item\Item;
use Btinet\Rpg\Monster\Monster;
use Btinet\Rpg\System\Out;

class Soldier extends Monster
{

    public function apply(Item $item, Character|Monster $entity): void
    {
        // TODO: Implement apply() method.
    }

    public function defend(): void
    {
        // TODO: Implement defend() method.
    }

    public function setup(): void
    {
        $this->abilities = [
          new MachineGun(),
          new Grenade()
        ];
    }

    public function main(Character|Monster $target): void
    {
        $this->setCurrentAttack($this->abilities[0]);
        Out::printLn("$this greift mit {$this->getCurrentAttack()} an!");
        $this->attack($target);
    }

    public function counter(Character|Monster $target): void
    {
        if($this->getHp() < $this->getHpMax()/2) {
            $this->setCurrentAttack($this->abilities[1]);
            Out::printLn("$this macht Gegenangriff mit {$this->getCurrentAttack()} an!");
            $this->attack($target);
        }
    }

}