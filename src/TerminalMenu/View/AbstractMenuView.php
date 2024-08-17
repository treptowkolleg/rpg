<?php

namespace Btinet\Rpg\TerminalMenu\View;

use Btinet\Rpg\Engine\SimpleTerminalEngine;
use Btinet\Rpg\TerminalMenu\TerminalMenu;

abstract class AbstractMenuView implements MenuViewInterface
{

    protected TerminalMenu $menu;

    protected SimpleTerminalEngine $engine;

    public function __construct(string $title, string $key, SimpleTerminalEngine $engine)
    {
        $this->menu = new TerminalMenu($title,$key);
        $this->engine = $engine;
        $this->setup();
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
