<?php

namespace Btinet\Rpg\Monster;

use Btinet\Rpg\Battle\BattleEntityInterface;
use JetBrains\PhpStorm\Pure;

class MonsterBuilder
{

    private string $name = "Monster";
    private int $exp = 4096;
    private int $hp = 100;
    private int $ap = 5;
    private float $apFactor = 1;
    private int $dp = 5;
    private float $dpFactor = 1;
    private float $hitRate = .96;
    private float $vp = 1;

    /**
     * @param string $name
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param int $exp
     * @return MonsterBuilder
     */
    public function setExp(int $exp): self
    {
        $this->exp = $exp;
        return $this;
    }

    /**
     * @param int $hp
     * @return MonsterBuilder
     */
    public function setHp(int $hp): self
    {
        $this->hp = $hp;
        return $this;
    }

    /**
     * @param int $ap
     * @return MonsterBuilder
     */
    public function setAp(int $ap): self
    {
        $this->ap = $ap;
        return $this;
    }

    /**
     * @param float|int $apFactor
     * @return MonsterBuilder
     */
    public function setApFactor(float|int $apFactor): self
    {
        $this->apFactor = $apFactor;
        return $this;
    }

    /**
     * @param int $dp
     * @return MonsterBuilder
     */
    public function setDp(int $dp): self
    {
        $this->dp = $dp;
        return $this;
    }

    /**
     * @param float|int $dpFactor
     * @return MonsterBuilder
     */
    public function setDpFactor(float|int $dpFactor): self
    {
        $this->dpFactor = $dpFactor;
        return $this;
    }

    /**
     * @param float $hitRate
     * @return MonsterBuilder
     */
    public function setHitRate(float $hitRate): self
    {
        $this->hitRate = $hitRate;
        return $this;
    }

    /**
     * @param float|int $vp
     * @return MonsterBuilder
     */
    public function setVp(float|int $vp): self
    {
        $this->vp = $vp;
        return $this;
    }

    #[Pure] public function build(): Monster
    {
        return new Monster($this->name, $this->exp, $this->hp, $this->ap, $this->apFactor, $this->dp, $this->dpFactor, $this->hitRate, $this->vp);
    }

}
