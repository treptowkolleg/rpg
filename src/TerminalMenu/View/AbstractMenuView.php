<?php

namespace Btinet\Rpg\TerminalMenu\View;

use Btinet\Rpg\Engine\SimpleTerminalEngine;
use Btinet\Rpg\TerminalMenu\TerminalMenu;

abstract class AbstractMenuView
{

    protected TerminalMenu $menu;

    protected SimpleTerminalEngine $engine;

    public function __construct(SimpleTerminalEngine $engine)
    {
        $this->engine = $engine;
    }

    public function getMenu(): TerminalMenu
    {
        return $this->menu;
    }

    public function getEngine(): SimpleTerminalEngine
    {
        return $this->engine;
    }

}
