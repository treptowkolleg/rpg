<?php

namespace Btinet\Rpg\Character;

class EndbossCharacter extends AbstractCharacter
{
    public function __construct(string $name, int $hp = 120, int $ap = 4, float $attackFactor = 1.0, int $dp = 3, float $defenseFactor = .7)
    {
        parent::__construct($name, $hp, $ap, $attackFactor, $dp, $defenseFactor);
    }

}