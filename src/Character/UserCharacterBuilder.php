<?php

namespace Btinet\Rpg\Character;

class UserCharacterBuilder
{

    private string $name;
    private int $hp = 120;
    private int $ap = 6;
    private float $attackFactor = 1.0;
    private int $dp = 6;
    private float $defenseFactor = .7;

    /**
     * @param string $name
     * @return UserCharacterBuilder
     */
    public function setName(string $name): UserCharacterBuilder
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param int $hp
     * @return UserCharacterBuilder
     */
    public function setHp(int $hp): UserCharacterBuilder
    {
        $this->hp = $hp;
        return $this;
    }

    /**
     * @param int $ap
     * @return UserCharacterBuilder
     */
    public function setAp(int $ap): UserCharacterBuilder
    {
        $this->ap = $ap;
        return $this;
    }

    /**
     * @param float $attackFactor
     * @return UserCharacterBuilder
     */
    public function setAttackFactor(float $attackFactor): UserCharacterBuilder
    {
        $this->attackFactor = $attackFactor;
        return $this;
    }

    /**
     * @param int $dp
     * @return UserCharacterBuilder
     */
    public function setDp(int $dp): UserCharacterBuilder
    {
        $this->dp = $dp;
        return $this;
    }

    /**
     * @param float $defenseFactor
     * @return UserCharacterBuilder
     */
    public function setDefenseFactor(float $defenseFactor): UserCharacterBuilder
    {
        $this->defenseFactor = $defenseFactor;
        return $this;
    }

    /**
     * @return UserCharacter
     */
    public function create(): UserCharacter
    {
        return new UserCharacter($this->name, $this->hp, $this->ap, $this->attackFactor, $this->dp, $this->defenseFactor);
    }

}
