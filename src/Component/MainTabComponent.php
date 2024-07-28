<?php

namespace Btinet\Rpg\Component;

use Btinet\Rpg\View\CharacterStatsView;
use Btinet\Rpg\View\ItemView;
use Btinet\Rpg\View\MonsterView;
use Btinet\Rpg\View\TestView;
use Btinet\Rpg\View\View;
use PhpTui\Term\Event\CharKeyEvent;
use PhpTui\Term\Event\CodedKeyEvent;
use PhpTui\Term\KeyCode;

class MainTabComponent
{

    public static function run(View $view, $event): bool
    {

        if($event  instanceof CharKeyEvent and $event->char === "a") {
            $view->notify("action:view","CharacterStatsView");
            $view->getTerminalEngine()->renderView(CharacterStatsView::class);
            return true;
        }

        if($event  instanceof CharKeyEvent and $event->char === "b") {
            $view->notify("action:view","ItemView");
            $view->getTerminalEngine()->renderView(TestView::class);
            return true;
        }

        if($event  instanceof CharKeyEvent and $event->char === "c") {
            $view->notify("action:view","ItemView");
            $view->getTerminalEngine()->renderView(ItemView::class);
            return true;
        }

        if($event  instanceof CharKeyEvent and $event->char === "d") {
            $view->notify("action:view","MonsterView");
            $view->getTerminalEngine()->renderView(MonsterView::class);
            return true;
        }
        return false;
    }

}