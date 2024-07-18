<?php

namespace Btinet\Rpg\Character;

use Btinet\Rpg\Battle\BattleEntityInterface;
use Btinet\Rpg\Character\Gear\Gear;
use Btinet\Rpg\Character\Stats\AttackPointTrait;
use Btinet\Rpg\Character\Stats\DefensePointTrait;
use Btinet\Rpg\Character\Stats\ExperienceTrait;
use Btinet\Rpg\Character\Stats\HealthPointTrait;
use Btinet\Rpg\Character\Stats\MoodPointTrait;
use Btinet\Rpg\Character\Stats\VitalityPointTrait;
use Btinet\Rpg\Character\Utility\LabelTrait;
use Btinet\Rpg\Character\Weapon\Weapon;
use Btinet\Rpg\Engine\ActionEngine;
use Btinet\Rpg\Item\Item;
use Btinet\Rpg\Monster\Monster;
use Btinet\Rpg\System\Out;
use Exception;

abstract class Character implements BattleEntityInterface
{
    // Label
    use LabelTrait;

    // Basic Stats
    use ExperienceTrait;
    use HealthPointTrait;
    use AttackPointTrait;
    use DefensePointTrait;

    // Extended Stats
    use VitalityPointTrait;
    use MoodPointTrait;

    // Gear
    private int $gearSlots = 0;
    /**
     * @var array<Gear>
     */
    private array $gearList = [];

    // Weapons
    private int $weaponSlots = 0;

    private ?Weapon $currentWeapon = null;

    /**
     * @var array<Weapon>
     */
    private array $weaponList = [];

    public function __construct
    (
        string $name,

        int $exp,
        int $hp,
        int $ap,
        float $apFactor,
        int $dp,
        float $dpFactor,

        float $vp,
        float $moodPoints,

        int $gearSlots,
        array $gearList,
        int $weaponSlots,
        array $weaponList,
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

        $this->vp = $vp;
        $this->moodPoints = $moodPoints;

        $this->gearSlots = $gearSlots;
        for($i = 0; $i < $gearSlots; $i++) {
            if(array_key_exists($i,$gearList))
                $this->gearList[$i] = $gearList[$i];
        }

        $this->weaponSlots = $weaponSlots;
        for($i = 0; $i < $weaponSlots; $i++) {
            if(array_key_exists($i,$weaponList))
                $this->weaponList[$i] = $weaponList[$i];
        }
    }

    public function attack(Character|Monster $entity): void
    {
        $selfAP = $this->getAp() - $entity->getDp();
        if($selfAP <= 0) {
            Out::printLn("Geblockt");
        } else {
            ActionEngine::missedHit($selfAP,$this->getEquippedWeapon()->getAttackMultiplication());
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

    /**
     * @return int
     * @throws Exception
     */
    public function getAp(): int
    {
        $weaponAp = 0;
        if($this->currentWeapon)
            $weaponAp = $this->currentWeapon?->getAp();
        return $this->getLeveledStat($this->ap * ActionEngine::differ($this->attackMultiplication) + $weaponAp);
    }

    /**
     * @return int
     * @throws Exception
     */
    public function getDp(): int
    {
        $gearDp = 0;
        foreach ($this->gearList as $gear) {
            $gearDp += $gear->getDp() * $gear->getDefenseMultiplication();
        }
        return $this->getLeveledStat($this->dp * ActionEngine::differ($this->defenseMultiplication) + $gearDp);
    }

    /**
     * @return int
     */
    public function getHp(): int
    {
        return $this->getLeveledStat($this->hpMax);
    }

    /**
     * @return float
     */
    public function getVp(): float
    {
        $gearVP = 0;
        foreach ($this->gearList as $gear)
            $gearVP += $gear->getVp();

        $weaponVP = 0;
        foreach ($this->weaponList as $weapon)
            $weaponVP += $weapon->getVp();

        return $this->getLeveledStat($this->vp) + $gearVP + $weaponVP;
    }

    /**
     * @return int
     */
    public function getGearSlots(): int
    {
        return $this->gearSlots;
    }

    /**
     * @return array<Gear>
     */
    public function getGearList(): array
    {
        return $this->gearList;
    }

    public function addGear(Gear $gear): self
    {
        if(count($this->gearList) < $this->gearSlots) {
            $this->gearList[] = $gear;
        }
        return $this;
    }

    public function replaceGear(int $index, Gear $gear): self
    {
        if(array_key_exists($index,$this->gearList)) {
            $this->gearList[$index] = $gear;
        }
        return $this;
    }

    public function removeGear(int $index): self
    {
        if(array_key_exists($index,$this->gearList)) {
            unset($this->gearList[$index]);
        }
        return $this;
    }

    public function getGear(int $index): ?Gear
    {
        if(array_key_exists($index,$this->gearList)) {
            return $this->gearList[$index];
        } else {
            return null;
        }
    }

    /**
     * @return int
     */
    public function getWeaponSlots(): int
    {
        return $this->weaponSlots;
    }

    /**
     * @return array<Weapon>
     */
    public function getWeaponList(): array
    {
        return $this->weaponList;
    }

    public function addWeapon(Weapon $weapon): self
    {
        if(count($this->weaponList) < $this->weaponSlots) {
            $this->weaponList[] = $weapon;
        }
        return $this;
    }

    public function replaceWeapon(int $index, Weapon $weapon): self
    {
        if(array_key_exists($index,$this->weaponList)) {
            $this->weaponList[$index] = $weapon;
        }
        return $this;
    }

    public function removeWeapon(int $index): self
    {
        if(array_key_exists($index,$this->weaponList)) {
            unset($this->weaponList[$index]);
        }
        return $this;
    }

    public function getWeapon(int $index): ?Weapon
    {
        if(array_key_exists($index,$this->weaponList)) {
            return $this->weaponList[$index];
        } else {
            return null;
        }
    }

    public function equipWeapon(Weapon $weapon): self
    {
        $this->currentWeapon = $weapon;
        return $this;
    }

    /**
     * @return Weapon|null
     */
    public function getEquippedWeapon(): ?Weapon
    {
        return $this->currentWeapon;
    }

}
