<?php

namespace Btinet\Rpg\Monster\Army;

use Btinet\Rpg\Ability\Grenade;
use Btinet\Rpg\Ability\MachineGun;
use Btinet\Rpg\Ability\SmokeBullet;
use Btinet\Rpg\Character\Character;
use Btinet\Rpg\Item\Item;
use Btinet\Rpg\Monster\Monster;

class Captain extends Monster
{

    public function apply(Item $item, Character|Monster $entity): void
    {
        // TODO: Implement apply() method.
    }

    public function defend(): void
    {
        // TODO: Implement defend() method.
    }

    /**
     * @inheritDoc
     */
    public function setup(): void
    {
        $this->setAbilities([
            new MachineGun(),
            new Grenade(),
            new SmokeBullet()
        ]);
    }

    /**
     * @inheritDoc
     */
    public function main(Character|Monster $target): void
    {
        // TODO: Implement main() method.
    }

    /**
     * @inheritDoc
     */
    public function counter(Character|Monster $target): void
    {
        // TODO: Implement counter() method.
    }
}