<?php

namespace Btinet\Rpg\Character\Predefined;

use Btinet\Rpg\Battle\BattleEntityInterface;
use Btinet\Rpg\Character\Character;
use Btinet\Rpg\Character\Gear\TitanBangle;
use Btinet\Rpg\Character\Weapon\BusterSword;
use Btinet\Rpg\Item\Item;

class Cloud extends Character
{

    public function __construct()
    {
        parent::__construct(
            "Cloud Strife",
            2048,
            120,
            10,
            1,
            9,
            1,
            1,
            1,
            1,
            [
                new TitanBangle()
            ],
            1,
            [
                new BusterSword()
            ]
        );

        $this->equipWeapon($this->getWeapon(0));
    }

    public function attack(BattleEntityInterface $entity): void
    {
        // TODO: Implement attack() method.
    }

    public function apply(Item $item, BattleEntityInterface $entity): void
    {
        // TODO: Implement apply() method.
    }

    public function defend(): void
    {
        // TODO: Implement defend() method.
    }
}
