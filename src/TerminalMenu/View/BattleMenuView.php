<?php

namespace Btinet\Rpg\TerminalMenu\View;

use Btinet\Rpg\System\Out;
use Btinet\Rpg\TerminalMenu\AbstractTerminalMenu;
use Btinet\Rpg\TerminalMenu\TerminalMenuItem;

class BattleMenuView extends AbstractMenuView
{


    public function setup(): void
    {
        $engine = $this->getEngine();
        $menu = $this->getMenu();

        $attackItem = new TerminalMenuItem("Angriff","1");
        $attackItem->addAction(function() use($engine, $menu) {
            $engine->getCurrentCharacter()->attack($engine->getCurrentMonster());
            if($engine->getCurrentMonster()->getHp() <= 0) {
                Out::printAlert("{$engine->getCurrentMonster()} wurde besiegt...");
                $engine->getCurrentCharacter()->restoreHp();
                $engine->getCurrentMonster()->restoreHp();

                if(!$engine->getCurrentMonster()->isDefeated()) {
                    foreach ($this->getEngine()->getSubMenu("g")->getChildren() as $item) {
                        if($item->getTitle() == $engine->getCurrentMonster()) {
                            $engine->getCurrentMonster()->setDefeated(true);
                            $item->setTitle($engine->getCurrentMonster());
                            break;
                        }
                    }
                }
                sleep(2);
                $menu->getParentMenu()->render();
            }
            $engine->getCurrentMonster()->counter($engine->getCurrentCharacter());
            $engine->getCurrentMonster()->main($engine->getCurrentCharacter());
        });

        $defendItem = new TerminalMenuItem("Verteidigen","2");
        $defendItem->addAction(function() use($engine) {
            $engine->getCurrentCharacter()->defend();
            $engine->getCurrentMonster()->main($engine->getCurrentCharacter());
            sleep(2);
        });

        $this->menu->addChildren($attackItem, $defendItem);
    }

}