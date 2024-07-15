<?php

namespace Btinet\Rpg\Config;

use Btinet\Rpg\Character\Character;
use Btinet\Rpg\Character\Gear\Gear;
use Btinet\Rpg\Character\Weapon\Weapon;
use Btinet\Rpg\Item\Item;
use Btinet\Rpg\Monster\Monster;

class Config implements ConfigInterface
{
    /**
     * @return array<Character>
     */
    public static function characterLibrary(): array
    {
        return [
            new \Btinet\Rpg\Character\Predefined\Cloud(),
            new \Btinet\Rpg\Character\Predefined\Tifa()
        ];
    }

    /**
     * @return array<Weapon>
     */
    public static function weaponLibrary(): array
    {
        return [

        ];
    }

    /**
     * @return array<Gear>
     */
    public static function gearLibrary(): array
    {
        return [

        ];
    }

    /**
     * @return array<Item>
     */
    public static function itemLibrary(): array
    {
        return [

        ];
    }

    /**
     * @return array<Monster>
     */
    public static function monsterLibrary(): array
    {
        return [

        ];
    }

    public static function new(): self
    {
        return new self;
    }

}


