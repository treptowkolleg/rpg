<?php

namespace Btinet\Rpg\TerminalMenu\View;

use Btinet\Rpg\Engine\SimpleTerminalEngine;
use Btinet\Rpg\System\Out;
use Btinet\Rpg\TerminalMenu\TerminalMenu;
use Btinet\Rpg\TerminalMenu\TerminalMenuItem;

class BattleMenuView extends AbstractMenuView
{

    private TerminalMenuItem $attackItem;
    private TerminalMenuItem $defendItem;

    public function __construct(SimpleTerminalEngine $engine)
    {

        $this->attackItem = new TerminalMenuItem("Angriff","1");
        $this->defendItem = new TerminalMenuItem("Verteidigen","2");

        $this->menu = new TerminalMenu("Kampf","k");
        $this->menu->addChildren($this->attackItem, $this->defendItem);

        parent::__construct($engine);
        $this->setup();
    }

    public function setup(): void
    {
        $engine = $this->getEngine();
        $menu = $this->getMenu();

        $this->attackItem->addAction(function() use($engine, $menu) {
            $engine->getCurrentCharacter()->attack($engine->getCurrentMonster());
            if($engine->getCurrentMonster()->getHp() <= 0) {
                Out::printAlert("{$engine->getCurrentMonster()} wurde besiegt...");
                $engine->getCurrentCharacter()->restoreHp();
                $engine->getCurrentMonster()->restoreHp();
                $engine->getCurrentMonster()->setDefeated(true);
                sleep(2);
                $menu->getParentMenu()->render();
            }
            $engine->getCurrentMonster()->counter($engine->getCurrentCharacter());
            $engine->getCurrentMonster()->main($engine->getCurrentCharacter());
        });

        $this->defendItem->addAction(function() use($engine) {
            $engine->getCurrentCharacter()->defend();
            $engine->getCurrentMonster()->main($engine->getCurrentCharacter());
            sleep(2);
        });

    }

}