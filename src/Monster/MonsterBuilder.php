<?php

namespace Btinet\Rpg\Monster;

use Btinet\Rpg\Battle\BattleEntityInterface;

abstract class MonsterBuilder
{
    protected MonsterFactory $factory;

    public function __construct()
    {

    }

    public static function AttackSquad(): Monster
    {
        $factory = new MonsterFactory();
        return $factory
            ->setName("Attack Squad")
            ->build();
    }

}