<?php

namespace Btinet\Rpg\Ability;

class Tonfa extends Ability
{


    public function __construct()
    {
        $this->setAp(6);
        parent::__construct("Tonfa");
    }
}