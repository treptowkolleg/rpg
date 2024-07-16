<?php

namespace Btinet\Rpg\Character\Predefined;

use Btinet\Rpg\Battle\BattleEntityInterface;
use Btinet\Rpg\Character\Character;
use Btinet\Rpg\Character\Gear\BronzeBangle;
use Btinet\Rpg\Character\Weapon\LeatherGlove;
use Btinet\Rpg\Item\Item;

class Tifa extends Character
{

    public function __construct()
    {
        parent::__construct(
            "Tifa Lockheart",
            5096,
            120,
            9,
            1,
            7,
            1,
            4,
            0,
            1,
            [
                new BronzeBangle()
            ],
            2,
            [
                new LeatherGlove()
            ]
        );
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
