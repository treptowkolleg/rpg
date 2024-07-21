<?php

namespace Btinet\Rpg\Monster;


abstract class MonsterFactory
{


    public static function RouletteCannon(): Monster
    {
        $factory = new MonsterBuilder();
        return $factory
            ->setName("Roulette Cannon")
            ->setExp(150000)
            ->build();
    }

    public static function RocketLauncher(): Monster
    {
        $factory = new MonsterBuilder();
        return $factory
            ->setName("Rocket Launcher")
            ->setExp(100000)
            ->build();
    }

    public static function MP(): Monster
    {
        $factory = new MonsterBuilder();
        return $factory
            ->setName("MP")
            ->setExp(50000)
            ->build();
    }

    public static function Captain(): Monster
    {
        $factory = new MonsterBuilder();
        return $factory
            ->setName("Captain")
            ->setExp(25000)
            ->build();
    }

    public static function AttackSquad(): Monster
    {
        $factory = new MonsterBuilder();
        return $factory
            ->setName("Attack Squad")
            ->setExp(5000)
            ->build();
    }

    public static function Marine(): Monster
    {
        $factory = new MonsterBuilder();
        return $factory
            ->setName("Marine")
            ->setExp(500)
            ->build();
    }

}