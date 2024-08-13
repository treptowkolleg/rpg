<?php

namespace Btinet\Rpg\Gear;

abstract class Weapon
{
    private int $ap;

    /**
     * @param int $ap
     */
    public function __construct(int $ap)
    {
        $this->ap = $ap;
    }

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


}