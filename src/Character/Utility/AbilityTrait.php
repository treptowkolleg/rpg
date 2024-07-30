<?php

namespace Btinet\Rpg\Character\Utility;

use Btinet\Rpg\Ability\Ability;

trait AbilityTrait
{

    /**
     * @var array<Ability>
     */
    protected array $abilities = [];

    /**
     * @return Ability[]
     */
    public function getAbilities(): array
    {
        return $this->abilities;
    }

    public function getAbility($index): ?Ability
    {
        if(array_key_exists($index,$this->abilities)) return $this->abilities[$index];
        return null;
    }

    /**
     * @param Ability[] $abilities
     */
    public function setAbilities(array $abilities): void
    {
        $this->abilities = $abilities;
    }

    public function addAbility(Ability $ability): void
    {
        $this->abilities[] = $ability;
        $this->abilities = array_unique($this->abilities);
    }

}
