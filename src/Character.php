<?php

namespace Btinet\Rpg;

class Character
{

    private string $name;

    /**
     * @var int Health Points
     */
    private int $hp;

    /**
     * @var int Attack Points
     */
    private int $ap;

    /**
     * @var float Attack Bonus Factor
     */
    private float $attackFactor;

    /**
     * @var int Defense Points
     */
    private int $dp;

    /**
     * @var float Defense Factor
     */
    private float $defenseFactor;


    /**
     * @param string $name
     * @param int $hp
     * @param int $ap
     * @param float $attackFactor
     * @param int $dp
     */
    public function __construct(string $name, int $hp = 120, int $ap = 6, float $attackFactor = 1.0, int $dp = 6, float $defenseFactor = .7)
    {
        $this->name = $name;
        $this->hp = $hp;
        $this->ap = $ap;
        $this->attackFactor = $attackFactor;
        $this->dp = $dp;
        $this->defenseFactor = $defenseFactor;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function attack(Character $character): void
    {
        if($character->getHp() <= 0) {
            echo "{$character} ist tot!\n";
        }

        $fiendHP = $character->getHp();
        $fiendDP = $character->getDp() * $character->getDefenseFactor();

        // Zufallskomplex
        $apRand = rand(70,130);
        if($apRand > 110) {
            if(rand(0,100) < 50) {
                $apRand = 1.1;
            }
        }
        $attackFactor = $this->attackFactor * $apRand / 100;

        $selfAP = ($this->ap * $attackFactor) - $fiendDP;

        if($selfAP <= 0) {
            $selfAP = 0;
            echo "{$character} hat geblockt!\n";
        } else {
            echo "{$this} attackiert {$character} mit {$selfAP} Angriffspunkten!\n";
        }

        $resultFiendHP = $fiendHP-$selfAP;




        // Angriff durchführen
        $character->setHp( round($resultFiendHP) );
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getHp(): int
    {
        return $this->hp;
    }

    /**
     * @return int
     */
    public function getAp(): int
    {
        return $this->ap;
    }

    /**
     * @return float
     */
    public function getAttackFactor(): float
    {
        return $this->attackFactor;
    }

    /**
     * @return int
     */
    public function getDp(): int
    {
        return $this->dp;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param int $hp
     */
    public function setHp(int $hp): void
    {
        $this->hp = $hp;
    }

    /**
     * @param int $ap
     */
    public function setAp(int $ap): void
    {
        $this->ap = $ap;
    }

    /**
     * @param float $attackFactor
     */
    public function setAttackFactor(float $attackFactor): void
    {
        $this->attackFactor = $attackFactor;
    }

    /**
     * @param int $dp
     */
    public function setDp(int $dp): void
    {
        $this->dp = $dp;
    }

    /**
     * @return float
     */
    public function getDefenseFactor(): float
    {
        return $this->defenseFactor;
    }

    /**
     * @param float $defenseFactor
     */
    public function setDefenseFactor(float $defenseFactor): void
    {
        $this->defenseFactor = $defenseFactor;
    }

}