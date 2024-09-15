<?php

namespace Btinet\Rpg\Monster\Army;

use Btinet\Rpg\Ability\MachineGun;
use Btinet\Rpg\Ability\SmokeBullet;
use Btinet\Rpg\Battle\BattleEntityInterface;
use Btinet\Rpg\Character\Character;
use Btinet\Rpg\Item\Item;
use Btinet\Rpg\Monster\Monster;

class Marine extends Monster
{

    public function apply(Item $item, BattleEntityInterface $entity): void
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
            new SmokeBullet()
        ]);
    }

    /**
     * @inheritDoc
     */
    public function main(BattleEntityInterface $target): void
    {
        // TODO: Implement main() method.
    }

    /**
     * @inheritDoc
     */
    public function counter(BattleEntityInterface $target): void
    {
        // TODO: Implement counter() method.
    }
}