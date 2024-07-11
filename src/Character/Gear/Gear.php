<?php

namespace Btinet\Rpg\Character\Gear;

use Btinet\Rpg\Character\Stats\DefensePointTrait;
use Btinet\Rpg\Character\Stats\VitalityPointTrait;
use Btinet\Rpg\Character\Utility\LabelTrait;

class Gear
{
    use LabelTrait;
    use DefensePointTrait;
    use VitalityPointTrait;

    public function __construct
    (
        string $name,
        int $dp,
        float $defenseFactor,
        float $vp,
    )
    {
        $this->label = $name;
        $this->dp = $dp;
        $this->defenseMultiplication = $defenseFactor;
        $this->vp = $vp;
    }

}