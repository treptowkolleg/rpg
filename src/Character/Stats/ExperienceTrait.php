<?php

namespace Btinet\Rpg\Character\Stats;

trait ExperienceTrait
{
    private int $exp;

    public function getLevel(): int
    {
        return round(log($this->exp));
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
        $this->exp = $exp;
    }

    public function addExp(int $exp): void
    {
        $this->exp += $exp;
    }

}
