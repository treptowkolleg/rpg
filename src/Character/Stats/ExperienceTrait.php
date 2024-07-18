<?php

namespace Btinet\Rpg\Character\Stats;

trait ExperienceTrait
{
    private int $exp;

    public function getLevel(): int
    {
        return round(log($this->exp) + $this->exp * pow(15,-3));
    }

    public function getLeveledStat(int|float $value): int
    {
        return round($value * sqrt($this->getLevel() ?? 1 )*2);
    }

    /**
     * @return int
     */
    public function getExp(): int
    {
        return $this->exp;
    }

    /**
     * @param int $exp
     */
    public function setExp(int $exp): void
    {
        if($exp >= 292000)
            $exp = 292000;
        $this->exp = $exp;
    }

    public function addExp(int $exp): void
    {
        $this->exp += $exp;
        if($this->exp >= 292000)
            $this->exp = 292000;
    }


}
