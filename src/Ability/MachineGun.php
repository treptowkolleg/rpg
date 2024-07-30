<?php

namespace Btinet\Rpg\Ability;

class MachineGun extends Ability
{

    public function __construct()
    {
        $this->setAp(6);
        parent::__construct("Maschinengewehr");
    }

}
