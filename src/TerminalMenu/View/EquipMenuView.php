<?php

namespace Btinet\Rpg\TerminalMenu\View;

use Btinet\Rpg\Engine\SimpleTerminalEngine;
use Btinet\Rpg\System\Out;
use Btinet\Rpg\TerminalMenu\TerminalMenu;
use Btinet\Rpg\TerminalMenu\TerminalMenuItem;

class EquipMenuView extends AbstractMenuView
{

    private TerminalMenuItem $weaponEquipMenuItem;
    private TerminalMenuItem $gearEquipMenuItem;

    public function __construct(SimpleTerminalEngine $engine)
    {

        $this->weaponEquipMenuItem = new TerminalMenuItem("Waffen","1");
        $this->gearEquipMenuItem = new TerminalMenuItem("Rüstung","2");

        $this->menu = new TerminalMenu("Ausrüstung","e");
        $this->menu->addChildren($this->weaponEquipMenuItem, $this->gearEquipMenuItem);

        parent::__construct($engine);
    }


    public function setup(): void
    {
        // TODO: Implement setup() method.
    }
}