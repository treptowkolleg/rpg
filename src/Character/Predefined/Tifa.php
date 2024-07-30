<?php

namespace Btinet\Rpg\Character\Predefined;

use Btinet\Rpg\Character\Character;
use Btinet\Rpg\Character\Gear\BronzeBangle;
use Btinet\Rpg\Character\Weapon\LeatherGlove;

class Tifa extends Character
{

    public function __construct()
    {
        parent::__construct(
            "Tifa Lockheart",
            "images/tifa.jpg",
            500,
            120,
            9,
            1,
            7,
            1,
            4,
            0,
            1,
            [
                new BronzeBangle()
            ],
            2,
            [
                new LeatherGlove()
            ]
        );
        $this->equipWeapon($this->getWeapon(0));
    }

}
