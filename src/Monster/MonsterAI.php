<?php

namespace Btinet\Rpg\Monster;

use Btinet\Rpg\Character\Character;

interface MonsterAI
{

    /**
     * AI einrichten
     */
    public function setup(): void;

    /**
     * Normaler Angriff
     */
    public function main(Character|Monster $target): void;

    /**
     * Gegenangriff
     */
    public function counter(Character|Monster $target): void;

}
