<?php

namespace Btinet\Rpg\Battle;

use Btinet\Rpg\Character\Character;
use Btinet\Rpg\Item\Item;
use Btinet\Rpg\Monster\Monster;

interface BattleEntityInterface
{
    public function attack(Character|Monster $entity): void;

    public function apply(Item $item, Character|Monster $entity): void;

    public function defend(): void;

}