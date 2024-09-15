<?php

namespace Btinet\Rpg\Monster\Army;

use Btinet\Rpg\Ability\MachineGun;
use Btinet\Rpg\Ability\Tonfa;
use Btinet\Rpg\Battle\BattleEntityInterface;
use Btinet\Rpg\Character\Character;
use Btinet\Rpg\Item\Item;
use Btinet\Rpg\Monster\Monster;
use Btinet\Rpg\System\Out;
use Btinet\Rpg\System\TextColor;

class MP extends Monster
{

    public function apply(Item $item, BattleEntityInterface $entity): void
    {
        // TODO: Implement apply() method.
    }

    public function defend(): void
    {
        // TODO: Implement defend() method.
    }

    /**
     * AI einrichten
     */
    public function setup(): void
    {
        $this->setAbilities([
            new MachineGun(),
            new Tonfa()
        ]);
    }

    /**
     * Normaler Angriff
     */
    public function main(BattleEntityInterface $target): void
    {
        $int = rand(0,count($this->abilities)-1);
        $this->setCurrentAttack($this->getAbility($int));
        Out::print("Angriff: ",TextColor::yellow);
        Out::print("{$this->getCurrentAttack()} ",TextColor::cyan);
        $this->attack($target);
    }

    /**
     * Gegenangriff
     */
    public function counter(BattleEntityInterface $target): void
    {

    }
}