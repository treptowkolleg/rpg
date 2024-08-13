<?php

namespace Btinet\Rpg\Character;

use Btinet\Rpg\Engine\ActionEngine;
use Btinet\Rpg\System\BackgroundColor;
use Btinet\Rpg\System\Out;
use Btinet\Rpg\System\TextColor;
use Exception;

abstract class AbstractCharacter
{

    protected string $name;

    /**
     * @var int Health Points
     */
    protected int $hp;

    /**
     * @var int Starting Health Points
     */
    private int $maxHP;

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
    private int $hasPoison = 0;


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
        $this->maxHP = $hp;
        $this->ap = $ap;
        $this->attackFactor = $attackFactor;
        $this->dp = $dp;
        $this->defenseFactor = $defenseFactor;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function attack(AbstractCharacter $character): void
    {
        echo "\e[39m⚔ $this greift $character an!\n";
        $fiendHP = $character->getHp();
        $fiendDP = $character->getDp();

        try {
            $fiendDefenseFactor = ActionEngine::differ($character->getDefenseFactor(),90,110,140);
            $attackFactor = ActionEngine::differ($this->attackFactor);
            $selfAP = round(($this->ap * $attackFactor) - ($fiendDP * $fiendDefenseFactor));
            $fiendDP = round($fiendDP * $fiendDefenseFactor);
        } catch (Exception $exception) {
            die($exception->getMessage() . "({$exception->getFile()})");
        }

        ActionEngine::criticalHit($selfAP);

        if($selfAP <= 0) {
            $selfAP = 0;
            echo "\e[34m\n";
            Out::printAlert("$character hat geblockt!", TextColor::black, BackgroundColor::cyan);
        } else {
            Out::printLn("⚔ $this attackiert $character mit $selfAP (Defense: $fiendDP) Angriffspunkten!", TextColor::yellow);
        }

        // Angriff durchführen
        $resultFiendHP = $fiendHP-$selfAP;
        $character->setHp($resultFiendHP);

        if($character->getHp() <= 0) {
            $character->setHp(0);
            Out::printAlert("$character ist tot!");
        } else {
            echo "\e[93m♡ $character hat nun {$character->getHp()}/{$character->getMaxHP()} HP!\n\n";
        }
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
    public function getMaxHP(): int
    {
        return $this->maxHP;
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

    public function hasPoison(): bool
    {
        return $this->hasPoison;
    }

    public function makePoisonDamage()
    {
        if($this->hasPoison >= 1) {
            $this->hp -= 50;
            echo "Gift auf $this\n";
            $this->hasPoison--;
            echo "{$this->hasPoison} an Gift übrig.\n";
        }
    }

    public function setPoison(int $counter) {
        $this->hasPoison = $counter;
    }

}