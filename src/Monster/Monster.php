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
use Btinet\Rpg\Character\Utility\AbilityTrait;
use Btinet\Rpg\Character\Utility\AvatarTrait;
use Btinet\Rpg\Character\Utility\LabelTrait;
use Btinet\Rpg\Engine\ActionEngine;
use Btinet\Rpg\System\Out;

abstract class Monster implements BattleEntityInterface, MonsterAI
{
    use LabelTrait;
    use AvatarTrait;
    use ExperienceTrait;
    use HealthPointTrait;
    use AttackPointTrait;
    use DefensePointTrait;
    use HitRateTrait;
    use VitalityPointTrait;
    use AbilityTrait;

    private string $currentAttack;
    private bool $defeated;

    public function __construct
    (
        string $name,
        string $avatar,
        int $exp,
        int $hp,
        int $ap,
        float $apFactor,
        int $dp,
        float $dpFactor,
        float $hitRate,
        float $vp,
        bool $defeated = false,
    )
    {
        $this->label = $name;
        $this->setAvatar($avatar);
        $this->exp = $exp;
        $this->hp = $this->getLeveledStat($hp);
        $this->hpMax = $hp;
        $this->ap = $ap;
        $this->attackMultiplication = $apFactor;
        $this->dp = $dp;
        $this->defenseMultiplication = $dpFactor;
        $this->hitRate = $hitRate;
        $this->vp = $vp;
        $this->defeated = $defeated;
        $this->setup();
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
        return $this->hp;
    }

    /**
     * @return int
     */
    public function getHpMax(): int
    {
        return $this->getLeveledStat($this->hpMax);
    }

    /**
     * @return string
     */
    public function getCurrentAttack(): string
    {
        return $this->currentAttack;
    }

    /**
     * @param string $currentAttack
     * @return Monster
     */
    public function setCurrentAttack(string $currentAttack): Monster
    {
        $this->currentAttack = $currentAttack;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDefeated(): bool
    {
        return $this->defeated;
    }

    /**
     * @param bool $defeated
     */
    public function setDefeated(bool $defeated): void
    {
        $this->defeated = $defeated;
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

}
