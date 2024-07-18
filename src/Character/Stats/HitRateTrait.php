<?php

namespace Btinet\Rpg\Character\Stats;

trait HitRateTrait
{

    private float $hitRate = 1;

    /**
     * @return float|int
     */
    public function getHitRate(): float|int
    {
        return $this->hitRate;
    }

    /**
     * @param float|int $hitRate
     */
    public function setHitRate(float|int $hitRate): void
    {
        $this->hitRate = $hitRate;
    }

}
