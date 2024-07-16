<?php

namespace Btinet\Rpg\Character\Weapon;

use Btinet\Rpg\Character\Stats\AttackPointTrait;
use Btinet\Rpg\Character\Stats\VitalityPointTrait;
use Btinet\Rpg\Character\Utility\LabelTrait;

abstract class Weapon
{
    use LabelTrait;
    use AttackPointTrait;
    use VitalityPointTrait;

    public function __construct
    (
        string $name,
        int $ap,
        float $apFactor,
        float $vp,
    )
    {
        $this->label = $name;
        $this->ap = $ap;
        $this->attackMultiplication = $apFactor;
        $this->vp = $vp;
    }

}
