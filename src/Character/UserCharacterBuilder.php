<?php

namespace Btinet\Rpg\Character;

use Btinet\Rpg\Gear\Sword;
use Btinet\Rpg\Item\Potion;

class UserCharacterBuilder
{

    private string $name;
    private string $avatar = '';
    private int $hp = 120;
    private int $ap = 6;
    private float $attackFactor = 1.0;
    private int $dp = 6;
    private float $defenseFactor = .7;
    private array $potions = [];

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
     * @param string $avatar
     * @return UserCharacterBuilder
     */
    public function setAvatar(string $avatar): UserCharacterBuilder
    {
        $this->avatar = $avatar;
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
     * @param array $potions
     */
    public function setPotions(array $potions): UserCharacterBuilder
    {
        $this->potions = $potions;
        return $this;
    }

    /**
     * @param Potion $potion
     * @return UserCharacterBuilder
     */
    public function addPotion(Potion $potion): UserCharacterBuilder
    {
        $this->potions[] = $potion;
        return $this;
    }

    /**
     * @return UserCharacter
     */
    public function create(): UserCharacter
    {
        return new UserCharacter($this->name, $this->avatar, $this->hp, $this->ap, $this->attackFactor, $this->dp, $this->defenseFactor, $this->potions);
    }

    public function addWepaon(Sword $param): UserCharacterBuilder
    {
        return $this;
    }

}
