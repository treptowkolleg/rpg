<?php

namespace Btinet\Rpg\Ability;

class SmokeBullet extends Ability
{

    public function __construct()
    {
        $this->setAp(14);
        parent::__construct("Rauchbombe");
    }

}
