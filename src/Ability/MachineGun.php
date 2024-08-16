<?php

namespace Btinet\Rpg\Ability;

class MachineGun extends Ability
{

    public function __construct()
    {
        $this->setAp(9);
        parent::__construct("Maschinengewehr");
    }

}
