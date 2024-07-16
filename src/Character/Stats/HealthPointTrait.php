<?php

namespace Btinet\Rpg\Character\Stats;

trait HealthPointTrait
{
    private int $hp;
    private int $hpMax;

    /**
     * @return int
     */
    public function getHp(): int
    {
        return $this->hp;
    }

    /**
     * @param int $hp
     */
    public function setHp(int $hp): void
    {
        $this->hp = $hp;
    }

    public function modifyHp(int $ap): void
    {
        $this->hp -= $ap;
    }

    /**
     * @return int
     */
    public function getHpMax(): int
    {
        return $this->hpMax;
    }

}
