<?php

namespace Btinet\Rpg\Character\Stats;

trait AttackPointTrait
{
    private int $ap;
    private float $attackMultiplication;

    /**
     * @return int
     */
    public function getAp(): int
    {
        return $this->ap;
    }

    /**
     * @param int $ap
     */
    public function setAp(int $ap): void
    {
        $this->ap = $ap;
    }

    /**
     * @return float
     */
    public function getAttackMultiplication(): float
    {
        return $this->attackMultiplication;
    }

    /**
     * @param float $attackMultiplication
     */
    public function setAttackMultiplication(float $attackMultiplication): void
    {
        $this->attackMultiplication = $attackMultiplication;
    }

}
