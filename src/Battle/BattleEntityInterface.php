<?php

namespace Btinet\Rpg\Battle;

use Btinet\Rpg\Item\Item;

interface BattleEntityInterface
{
    public function attack(BattleEntityInterface $entity): void;

    public function apply(Item $item, BattleEntityInterface $entity): void;

    public function defend(): void;

}