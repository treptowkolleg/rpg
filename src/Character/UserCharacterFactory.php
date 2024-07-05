<?php

namespace Btinet\Rpg\Character;

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
            ->create()
            ;
    }

}