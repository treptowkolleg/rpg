<?php

namespace Btinet\Rpg\Character;

class UserCharacterBuilder
{

    private string $name;
    private int $hp;
    private int $ap;
    private float $attackFactor;
    private int $dp;
    private float $defenseFactor;

    /**
     * @param string $name
     */
    public function setName(string $name): UserCharacterBuilder
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param int $hp
     */
    public function setHp(int $hp): UserCharacterBuilder
    {
        $this->hp = $hp;
        return $this;
    }

    /**
     * @param int $ap
     */
    public function setAp(int $ap): UserCharacterBuilder
    {
        $this->ap = $ap;
        return $this;
    }

    /**
     * @param float $attackFactor
     */
    public function setAttackFactor(float $attackFactor): UserCharacterBuilder
    {
        $this->attackFactor = $attackFactor;
        return $this;
    }

    /**
     * @param int $dp
     */
    public function setDp(int $dp): UserCharacterBuilder
    {
        $this->dp = $dp;
        return $this;
    }

    /**
     * @param float $defenseFactor
     */
    public function setDefenseFactor(float $defenseFactor): UserCharacterBuilder
    {
        $this->defenseFactor = $defenseFactor;
        return $this;
    }

    public function create(): UserCharacter
    {
        return new UserCharacter($this->name, $this->hp, $this->ap, $this->attackFactor, $this->dp, $this->defenseFactor);
    }

}
