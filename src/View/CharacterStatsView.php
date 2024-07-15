<?php

namespace Btinet\Rpg\View;

use PhpTui\Tui\Extension\Core\Widget\ParagraphWidget;
use PhpTui\Tui\Extension\Core\Widget\Table\TableRow;
use PhpTui\Tui\Extension\Core\Widget\TableWidget;
use PhpTui\Tui\Layout\Constraint;
use PhpTui\Tui\Style\Style;

class CharacterStatsView extends View
{
    private TableWidget $table;

    public function run(): void
    {
        $this->clear()->draw(ParagraphWidget::fromString("a für View, b für TestView"));
        while (true) {
            $input = $this->input();
            if($input === "a") {
                $this->renderWidget($this->table);
            }

            if($input === "b") {
                $this->getTerminalEngine()->renderView(TestView::class);
                break;
            }
        }
    }

    /**
     * Lege hier deine Widgets an. Nutze am besten Klassenattribute, um zwischendurch darauf zugreifen zu können.
     */
    public function setup(): void
    {
        $charRows = [];

        foreach ($this->getTerminalEngine()->getCharacterList() as $char) {
            $charRows[] = TableRow::fromStrings(
                $char,
                $char->getHp(),
                $char->getAp(),
                $char->getDp(),
                $char->getVp(),
                $char->getMoodPoints(),
                $char->getExp(),
                $char->getLevel(),
                $char->getWeapon(0) ?? '',
                $char->getGear(0) ?? '',
            );
        }

        $this->table = TableWidget::default()
            ->widths(
                Constraint::percentage(10),
                Constraint::percentage(10),
                Constraint::percentage(10),
                Constraint::percentage(10),
                Constraint::percentage(10),
                Constraint::percentage(10),
                Constraint::percentage(10),
                Constraint::percentage(10),
                Constraint::percentage(10),
                Constraint::percentage(10),
            )
            ->highlightStyle(Style::default()->white()->onBlue())
            ->header(
                TableRow::fromStrings(
                    'Character',
                    'HP',
                    'Attack',
                    'Defense',
                    'Vitality',
                    'Mood',
                    'EXP',
                    'Level',
                    '1. Waffe',
                    '1. Rüstung',
                )->height(1)->bottomMargin(1)
            )
            ->select(0)
        ;
        $this->table->rows = array_values($charRows);
    }

}
