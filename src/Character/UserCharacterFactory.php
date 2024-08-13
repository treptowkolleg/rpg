<?php

namespace Btinet\Rpg\Character;

use Btinet\Rpg\Gear\Sword;
use Btinet\Rpg\Item\Potion;

class UserCharacterFactory
{

    public static function Sigmar(): UserCharacter
    {
        $builder = new UserCharacterBuilder();
        return $builder
            ->setName("Sigmar")
            ->setHp(250)
            ->setAp(64)
            ->setAttackFactor(1.5)
            ->setDp(53)
            ->setDefenseFactor(2)
            ->addWepaon(new Sword())
            ->addPotion(new Potion())
            ->addPotion(new Potion())
            ->addPotion(new Potion())
            ->create()
            ;
    }

    public static function Archaon(): UserCharacter
    {
        $builder = new UserCharacterBuilder();
        return $builder
            ->setName("Archaon")
            ->setHp(720)
            ->setAp(69)
            ->setAttackFactor(2)
            ->setDp(70)
            ->setDefenseFactor(.5)
            ->addPotion(new Potion())
            ->addPotion(new Potion())
            ->addPotion(new Potion())
            ->create()
            ;
    }

    public static function Ultima(): UserCharacter
    {
        $builder = new UserCharacterBuilder();
        return $builder
            ->setName("Ultima")
            ->setHp(20000)
            ->setAp(40)
            ->setAttackFactor(1.5)
            ->setDp(70)
            ->setDefenseFactor(.5)
            ->create()
            ;
    }

}