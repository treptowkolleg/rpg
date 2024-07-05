<?php

namespace Btinet\Rpg\Character;

class UserCharacter extends AbstractCharacter
{
    public function __construct(string $name, int $hp, int $ap, float $attackFactor, int $dp, float $defenseFactor)
    {
        parent::__construct($name, $hp, $ap, $attackFactor, $dp, $defenseFactor);
    }

}