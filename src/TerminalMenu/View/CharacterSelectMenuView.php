<?php

namespace Btinet\Rpg\TerminalMenu\View;

use Btinet\Rpg\System\Out;
use Btinet\Rpg\TerminalMenu\TerminalMenuItem;

class CharacterSelectMenuView extends AbstractMenuView
{

    public function setup(): void
    {
        $engine = $this->getEngine();
        $menu = $this->getMenu();

        foreach ($engine->getCharacterList() as $key => $character) {
            $monsterItem = new TerminalMenuItem($character,$key);
            $monsterItem->addAction(function() use($engine, $key, $character, $menu) {
                $engine->setCurrentCharacter($key);
                Out::print("{$character->getLabel()}");
                Out::printLn(" wurde ausgewählt.");
                sleep(2);
                $menu->getParentMenu()->render();
            });
            $menu->addChildren($monsterItem);
        }
    }

}