<?php

namespace Btinet\Rpg\Ability;

use Btinet\Rpg\Character\Stats\AttackPointTrait;
use Btinet\Rpg\Character\Utility\LabelTrait;

abstract class Ability
{
    use LabelTrait;
    use AttackPointTrait;


    public function __construct(string $label)
    {
        $this->label = $label;
    }
}