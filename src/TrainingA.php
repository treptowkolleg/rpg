<?php

namespace Btinet\Rpg;

use Btinet\Rpg\Character\Character;

class TrainingA
{

    /**
     * @var array<Character>
     */
    private array $chars = [];

    public function addChar(Character $char): void
    {
        $this->chars[] = $char;
    }

    public function addChars(Character ...$chars): void
    {
        $this->chars = array_merge($this->chars, $chars);
    }

    public function getHpFromCharAt(int $index): int
    {
        return $this->chars[$index]->getHp();
    }

    public function modifyNormal($parameter): float|int
    {
        return $parameter * 2;
    }

    public function modifyByReference(&$parameter): void
    {
        $parameter *= 2;
    }

}