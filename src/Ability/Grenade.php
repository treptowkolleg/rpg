<?php

namespace Btinet\Rpg\Ability;

class Grenade extends Ability
{

    public function __construct()
    {
        $this->setAp(12);
        parent::__construct("Granate");
    }

}
