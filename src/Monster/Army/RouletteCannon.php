<?php

namespace Btinet\Rpg\Monster\Army;

use Btinet\Rpg\Battle\BattleEntityInterface;
use Btinet\Rpg\Character\Character;
use Btinet\Rpg\Item\Item;
use Btinet\Rpg\Monster\Monster;

class RouletteCannon extends Monster
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
     * AI einrichten
     */
    public function setup(): void
    {
        $this->setAbilities([

        ]);
    }

    /**
     * Normaler Angriff
     */
    public function main(BattleEntityInterface $target): void
    {
        // TODO: Implement main() method.
    }

    /**
     * Gegenangriff
     */
    public function counter(BattleEntityInterface $target): void
    {
        // TODO: Implement counter() method.
    }
}