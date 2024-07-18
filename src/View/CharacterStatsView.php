<?php

namespace Btinet\Rpg\View;

use Btinet\Rpg\Component\BlockComponent;
use Btinet\Rpg\Engine\FileEngine;
use PhpTui\Tui\Extension\Core\Widget\BlockWidget;
use PhpTui\Tui\Extension\Core\Widget\ParagraphWidget;
use PhpTui\Tui\Extension\Core\Widget\Table\TableRow;
use PhpTui\Tui\Extension\Core\Widget\TableWidget;
use PhpTui\Tui\Layout\Constraint;
use PhpTui\Tui\Style\Style;
use PhpTui\Tui\Text\Title;
use PhpTui\Tui\Widget\Borders;
use PhpTui\Tui\Widget\HorizontalAlignment;
use PhpTui\Tui\Widget\VerticalAlignment;

class CharacterStatsView extends View
{
    private TableWidget $table;

    public function run(): void
    {
        $this->clear()->draw(ParagraphWidget::fromString("a für View, b für TestView"));

        while (true) {
            $input = $this->input();
            if($input === "a") {
                $this->renderWidget(BlockComponent::create("Character Statistics",$this->table));
            }
            if($input === "b") {
                $this->getTerminalEngine()->renderView(TestView::class);
                break;
            }
            if($input === "0") {
                FileEngine::saveGame($this->getTerminalEngine());

                $this->renderWidget(BlockWidget::default()
                    ->style(Style::default()->green())
                    ->borders(Borders::ALL)
                    ->widget(
                        ParagraphWidget::fromString("Spielstand gespeichert!")
                            ->alignment(HorizontalAlignment::Center)
                            ->style(Style::default()->green())
                    )
                );
                sleep(3);
                $this->renderWidget(BlockComponent::create("Character Statistics",$this->table));
            }
            if($input === "-") {
                $selectedIndex = $this->table->state->selected;
                if($selectedIndex > 0) {
                    $this->table->select(--$selectedIndex);
                }
                $this->renderWidget(BlockComponent::create("Character Statistics",$this->table));
            }
            if($input === "+") {
                $rowCount = count($this->table->rows)-1;
                $selectedIndex = $this->table->state->selected;
                if($selectedIndex < $rowCount) {
                    $this->table->select(++$selectedIndex);
                }
                $this->renderWidget(BlockComponent::create("Character Statistics",$this->table));
            }
        }
    }

    /**
     * Lege hier deine Widgets an. Nutze am besten Klassenattribute, um zwischendurch darauf zugreifen zu können.
     */
    public function setup(): self
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
                $char->getEquippedWeapon() ?? '',
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
        return $this;
    }

}
