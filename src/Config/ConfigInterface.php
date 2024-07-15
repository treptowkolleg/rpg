<?php

namespace Btinet\Rpg\Config;

use Btinet\Rpg\Character\Character;
use Btinet\Rpg\Character\Gear\Gear;
use Btinet\Rpg\Character\Weapon\Weapon;
use Btinet\Rpg\Item\Item;
use Btinet\Rpg\Monster\Monster;

interface ConfigInterface
{
    /**
     * @return array<Character>
     */
    public static function characterLibrary(): array;

    /**
     * @return array<Weapon>
     */
    public static function weaponLibrary(): array;

    /**
     * @return array<Gear>
     */
    public static function gearLibrary(): array;

    /**
     * @return array<Item>
     */
    public static function itemLibrary(): array;

    /**
     * @return array<Monster>
     */
    public static function monsterLibrary(): array;

    public static function new(): self;
}