<?php

namespace Btinet\Rpg\Character;

use Btinet\Rpg\Character\Stats\AttackPointTrait;
use Btinet\Rpg\Character\Stats\DefensePointTrait;
use Btinet\Rpg\Character\Stats\ExperienceTrait;
use Btinet\Rpg\Character\Stats\HealthPointTrait;
use Btinet\Rpg\Character\Stats\MoodPointTrait;
use Btinet\Rpg\Character\Stats\VitalityPointTrait;
use Btinet\Rpg\Character\Utility\LabelTrait;

class Character
{
    // Label
    use LabelTrait;

    // Basic Stats
    use ExperienceTrait;
    use HealthPointTrait;
    use AttackPointTrait;
    use DefensePointTrait;

    // Extended Stats
    use VitalityPointTrait;
    use MoodPointTrait;

    public function __construct
    (
        string $name,

        int $exp,
        int $hp,
        int $ap,
        float $apFactor,
        int $dp,
        float $dpFactor,

        float $vp,
        float $moodPoints,
    )
    {
        $this->label = $name;

        $this->exp = $exp;
        $this->hp = $hp;
        $this->hpMax = $hp;
        $this->ap = $ap;
        $this->attackMultiplication = $apFactor;
        $this->dp = $dp;
        $this->defenseMultiplication = $dpFactor;

        $this->vp = $vp;
        $this->moodPoints = $moodPoints;
    }

}