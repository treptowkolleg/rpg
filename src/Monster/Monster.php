<?php

namespace Btinet\Rpg\Monster;

use Btinet\Rpg\Battle\BattleEntityInterface;
use Btinet\Rpg\Character\Character;
use Btinet\Rpg\Character\Stats\AttackPointTrait;
use Btinet\Rpg\Character\Stats\DefensePointTrait;
use Btinet\Rpg\Character\Stats\ExperienceTrait;
use Btinet\Rpg\Character\Stats\HealthPointTrait;
use Btinet\Rpg\Character\Stats\HitRateTrait;
use Btinet\Rpg\Character\Stats\VitalityPointTrait;
use Btinet\Rpg\Character\Utility\LabelTrait;
use Btinet\Rpg\Engine\ActionEngine;
use Btinet\Rpg\Item\Item;
use Btinet\Rpg\System\Out;

abstract class Monster implements BattleEntityInterface
{
    use LabelTrait;
    use ExperienceTrait;
    use HealthPointTrait;
    use AttackPointTrait;
    use DefensePointTrait;
    use HitRateTrait;
    use VitalityPointTrait;

    public function __construct
    (
        string $name,
        int $exp,
        int $hp,
        int $ap,
        float $apFactor,
        int $dp,
        float $dpFactor,
        float $hitRate,
        float $vp,
    )
    {
        $this->label = $name;
        $this->exp = $exp;
        $this->hp = $hp;
        $this->hpMax = $hp;
        $this->ap = $ap;
        $this->attackMultiplication = $apFactor;
        $this->dp = $dp;
        $this->defenseMultiplication = $dpFactor;
        $this->hitRate = $hitRate;
        $this->vp = $vp;
    }

    /**
     * @return int
     */
    public function getAp(): int
    {
        return $this->getLeveledStat($this->ap * $this->attackMultiplication);
    }

    /**
     * @return int
     */
    public function getDp(): int
    {
        return $this->getLeveledStat($this->dp * $this->defenseMultiplication);
    }

    /**
     * @return int
     */
    public function getHp(): int
    {
        return $this->getLeveledStat($this->hp);
    }

    public function attack(Character|Monster $entity): void
    {
        $selfAP = $this->getAp() - $entity->getDp();
        if($selfAP <= 0) {
            Out::printLn("Geblockt");
        } else {
            ActionEngine::missedHit($selfAP,$this->getHitRate());
            if($selfAP > 0)
                ActionEngine::criticalHit($selfAP);
        }
        $entity->modifyHp($selfAP);
    }

    public function apply(Item $item, BattleEntityInterface $entity): void
    {
        // TODO: Implement apply() method.
    }

    public function defend(): void
    {
        // TODO: Implement defend() method.
    }

}
