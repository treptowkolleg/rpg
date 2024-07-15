<?php

namespace Btinet\Rpg\Character\Predefined;

use Btinet\Rpg\Character\Character;
use Btinet\Rpg\Character\Weapon\BusterSword;

class Cloud extends Character
{

    public function __construct()
    {
        parent::__construct(
            "Cloud",
            2048,
            120,
            10,
            1,
            9,
            1,
            1,
            1,
            1,
            [],
            1,
            [
                new BusterSword()
            ]
        );
    }

}
