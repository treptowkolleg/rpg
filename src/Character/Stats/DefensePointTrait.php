<?php

namespace Btinet\Rpg\Character\Stats;

trait DefensePointTrait
{
    private int $dp;
    private float $defenseMultiplication;

    /**
     * @return int
     */
    public function getDp(): int
    {
        return $this->dp;
    }

    /**
     * @param int $dp
     */
    public function setDp(int $dp): void
    {
        $this->dp = $dp;
    }

    /**
     * @return float
     */
    public function getDefenseMultiplication(): float
    {
        return $this->defenseMultiplication;
    }

    /**
     * @param float $defenseMultiplication
     */
    public function setDefenseMultiplication(float $defenseMultiplication): void
    {
        $this->defenseMultiplication = $defenseMultiplication;
    }

}
