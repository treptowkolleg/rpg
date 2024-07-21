<?php

namespace Btinet\Rpg\Config;

use Btinet\Rpg\Character\Character;
use Btinet\Rpg\Character\Gear\BronzeBangle;
use Btinet\Rpg\Character\Gear\Gear;
use Btinet\Rpg\Character\Gear\TitanBangle;
use Btinet\Rpg\Character\Predefined\Cloud;
use Btinet\Rpg\Character\Predefined\Tifa;
use Btinet\Rpg\Character\Weapon\BusterSword;
use Btinet\Rpg\Character\Weapon\ButterflyEdge;
use Btinet\Rpg\Character\Weapon\HardEdge;
use Btinet\Rpg\Character\Weapon\LeatherGlove;
use Btinet\Rpg\Character\Weapon\MythrilSaber;
use Btinet\Rpg\Character\Weapon\Weapon;
use Btinet\Rpg\Item\Item;
use Btinet\Rpg\Item\Potion;
use Btinet\Rpg\Monster\Army\AttackSquad;
use Btinet\Rpg\Monster\Monster;
use Btinet\Rpg\Monster\MonsterFactory;

class Config implements ConfigInterface
{
    /**
     * @return array<Character>
     */
    public static function characterLibrary(): array
    {
        return [
            new Cloud(),
            new Tifa()
        ];
    }

    /**
     * @return array<Weapon>
     */
    public static function weaponLibrary(): array
    {
        return [
            new BusterSword(),
            new HardEdge(),
            new ButterflyEdge(),
            new MythrilSaber(),
            new LeatherGlove()
        ];
    }

    /**
     * @return array<Gear>
     */
    public static function gearLibrary(): array
    {
        return [
            new BronzeBangle(),
            new TitanBangle()
        ];
    }

    /**
     * @return array<Item>
     */
    public static function itemLibrary(): array
    {
        return [
            new Potion()
        ];
    }

    /**
     * @return array<Monster>
     */
    public static function monsterLibrary(): array
    {
        return [
            MonsterFactory::RouletteCannon(),
            MonsterFactory::RocketLauncher(),
            MonsterFactory::MP(),
            MonsterFactory::Captain(),
            MonsterFactory::AttackSquad(),
            MonsterFactory::Marine(),
        ];
    }

    public static function new(): self
    {
        return new self;
    }

}


