<?php

namespace Btinet\Rpg\Monster;


use Btinet\Rpg\Monster\Army\AttackSquad;
use Btinet\Rpg\Monster\Army\Captain;
use Btinet\Rpg\Monster\Army\Marine;
use Btinet\Rpg\Monster\Army\MP;
use Btinet\Rpg\Monster\Army\RocketLauncher;
use Btinet\Rpg\Monster\Army\RouletteCannon;

abstract class MonsterFactory
{


    public static function RouletteCannon(): Monster
    {
        $factory = new MonsterBuilder();
        return $factory
            ->setName("Roulette Cannon")
            ->setAvatar("images/rouletteCanon.jpg")
            ->setExp(150000)
            ->build(RouletteCannon::class);
    }

    public static function RocketLauncher(): Monster
    {
        $factory = new MonsterBuilder();
        return $factory
            ->setName("Rocket Launcher")
            ->setExp(100000)
            ->build(RocketLauncher::class);
    }

    public static function MP(): Monster
    {
        $factory = new MonsterBuilder();
        return $factory
            ->setName("MP")
            ->setExp(50000)
            ->build(MP::class);
    }

    public static function Captain(): Monster
    {
        $factory = new MonsterBuilder();
        return $factory
            ->setName("Captain")
            ->setExp(25000)
            ->build(Captain::class);
    }

    public static function AttackSquad(): Monster
    {
        $factory = new MonsterBuilder();
        return $factory
            ->setName("Attack Squad")
            ->setExp(5000)
            ->build(AttackSquad::class);
    }

    public static function Marine(): Monster
    {
        $factory = new MonsterBuilder();
        return $factory
            ->setName("Marine")
            ->setExp(500)
            ->setDefeated(true)
            ->build(Marine::class);
    }

}