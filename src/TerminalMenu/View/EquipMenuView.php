<?php

namespace Btinet\Rpg\TerminalMenu\View;

use Btinet\Rpg\TerminalMenu\TerminalMenuItem;

class EquipMenuView extends AbstractMenuView
{

    public function setup(): void
    {
        $weaponEquipMenuItem = new TerminalMenuItem("Waffen","1");
        $gearEquipMenuItem = new TerminalMenuItem("Rüstung","2");
        $this->menu->addChildren($weaponEquipMenuItem, $gearEquipMenuItem);
    }

}