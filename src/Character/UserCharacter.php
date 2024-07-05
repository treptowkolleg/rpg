<?php

namespace Btinet\Rpg\Character;

class UserCharacter extends AbstractCharacter
{
    public function __construct(string $name, int $hp = 120, int $ap = 6, float $attackFactor = 1.0, int $dp = 6, float $defenseFactor = .7)
    {
        parent::__construct($name, $hp, $ap, $attackFactor, $dp, $defenseFactor);
    }

}