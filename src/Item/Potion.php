<?php

namespace Btinet\Rpg\Item;

class Potion
{

    private int $hp = 50;

    /**
     * @return int
     */
    public function getHp(): int
    {
        return $this->hp;
    }

}
