<?php

namespace Btinet\Rpg\Monster;

use Btinet\Rpg\Battle\BattleEntityInterface;

interface MonsterAI
{

    /**
     * AI einrichten
     */
    public function setup(): void;

    /**
     * Normaler Angriff
     */
    public function main(BattleEntityInterface $target): void;

    /**
     * Gegenangriff
     */
    public function counter(BattleEntityInterface $target): void;

}
