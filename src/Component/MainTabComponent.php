<?php

namespace Btinet\Rpg\Component;

use Btinet\Rpg\View\CharacterStatsView;
use Btinet\Rpg\View\ItemView;
use Btinet\Rpg\View\MonsterView;
use Btinet\Rpg\View\TestView;
use Btinet\Rpg\View\View;

class MainTabComponent
{

    public static function run(View $view, $input): bool
    {
        if($input === "a") {
            $view->notify("action:view","CharacterStatsView");
            $view->getTerminalEngine()->renderView(CharacterStatsView::class);
            return true;
        }

        if($input === "b") {
            $view->notify("action:view","ItemView");
            $view->getTerminalEngine()->renderView(TestView::class);
            return true;
        }

        if($input === "c") {
            $view->notify("action:view","ItemView");
            $view->getTerminalEngine()->renderView(ItemView::class);
            return true;
        }

        if($input === "d") {
            $view->notify("action:view","MonsterView");
            $view->getTerminalEngine()->renderView(MonsterView::class);
            return true;
        }
        return false;
    }

}