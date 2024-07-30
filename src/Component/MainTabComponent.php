<?php

namespace Btinet\Rpg\Component;

use Btinet\Rpg\Engine\FileEngine;
use Btinet\Rpg\System\BackgroundColor;
use Btinet\Rpg\System\Out;
use Btinet\Rpg\System\TextColor;
use Btinet\Rpg\View\CharacterStatsView;
use Btinet\Rpg\View\ItemView;
use Btinet\Rpg\View\MonsterView;
use Btinet\Rpg\View\EquipView;
use Btinet\Rpg\View\View;
use PhpTui\Term\Event\CharKeyEvent;
use PhpTui\Term\Event\CodedKeyEvent;
use PhpTui\Term\KeyCode;
use PhpTui\Tui\Extension\Core\Widget\BlockWidget;
use PhpTui\Tui\Extension\Core\Widget\ParagraphWidget;
use PhpTui\Tui\Style\Style;
use PhpTui\Tui\Widget\Borders;
use PhpTui\Tui\Widget\HorizontalAlignment;

class MainTabComponent
{

    public static function run(View $view, $event, $tab = 0): bool
    {
        if ($event instanceof CodedKeyEvent and $event->code === KeyCode::Insert) {
            FileEngine::saveGame($view->getTerminalEngine());
            $view->notify("action:save");

            $view->renderWidget(BlockWidget::default()
                ->style(Style::default()->lightBlue())
                ->borders(Borders::ALL)
                ->widget(
                    ParagraphWidget::fromString("Spielstand wird gespeichert...")
                        ->alignment(HorizontalAlignment::Center)
                        ->style(Style::default()->lightRed())
                )
            ,$tab);
            sleep(3);
            $view->renderWidget(BlockWidget::default()
                ->style(Style::default()->lightBlue())
                ->borders(Borders::ALL)
                ->widget(
                    ParagraphWidget::fromString("Tab auswählen, um fortzufahren...")
                        ->alignment(HorizontalAlignment::Center)
                        ->style(Style::default()->white())
                )
                ,$tab);
        }

        if ($event  instanceof CodedKeyEvent and $event->code === KeyCode::Delete) {
            $view->notify("action:system","shutdown");
            $view->getTerminalEngine()->getDisplay()->clear();
            Out::printAlert("Spiel wird beendet...", TextColor::lightBlue,BackgroundColor::black);
            sleep(3);
            $view->getTerminalEngine()->getDisplay()->clear();
            return true;
        }

        if($event  instanceof CharKeyEvent and $event->char === "a") {
            $view->notify("action:view","CharacterStatsView");
            $view->getTerminalEngine()->renderView(CharacterStatsView::class);
            return true;
        }

        if($event  instanceof CharKeyEvent and $event->char === "b") {
            $view->notify("action:view","ItemView");
            $view->getTerminalEngine()->renderView(EquipView::class);
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
