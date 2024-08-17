<?php

namespace Btinet\Rpg\TerminalMenu\View;

use Btinet\Rpg\Engine\SimpleTerminalEngine;
use Btinet\Rpg\System\Out;
use Btinet\Rpg\TerminalMenu\TerminalMenu;
use Btinet\Rpg\TerminalMenu\TerminalMenuItem;

class EnemySelectMenuView extends AbstractMenuView
{

    public function __construct(SimpleTerminalEngine $engine)
    {
        $this->menu = new TerminalMenu("Gegnerdatenbank","g");

        parent::__construct($engine);
    }

    public function setup(): void
    {
        $engine = $this->getEngine();
        $menu = $this->getMenu();

        foreach ($engine->getMonsterList() as $key => $monster) {
            $monsterItem = new TerminalMenuItem($monster,$key);
            $monsterItem->addAction(function() use($engine, $key, $monster, $menu) {
                $engine->setCurrentMonster($key);
                Out::print("{$monster->getLabel()}");
                Out::printLn(" wurde ausgewählt.");
                sleep(2);
                $menu->getParentMenu()->render();
            });
            $menu->addChildren($monsterItem);
        }
    }

}