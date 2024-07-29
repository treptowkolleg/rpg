<?php

namespace Btinet\Rpg\View;

use Btinet\Rpg\Component\BlockComponent;
use Btinet\Rpg\Component\MainTabComponent;
use Btinet\Rpg\Engine\FileEngine;
use Btinet\Rpg\System\BackgroundColor;
use Btinet\Rpg\System\Out;
use Btinet\Rpg\System\TextColor;
use PhpTui\Term\Event\CharKeyEvent;
use PhpTui\Term\Event\CodedKeyEvent;
use PhpTui\Term\Event\KeyEvent;
use PhpTui\Term\KeyCode;
use PhpTui\Tui\Extension\Core\Widget\BlockWidget;
use PhpTui\Tui\Extension\Core\Widget\ParagraphWidget;
use PhpTui\Tui\Extension\Core\Widget\Table\TableRow;
use PhpTui\Tui\Extension\Core\Widget\TableWidget;
use PhpTui\Tui\Layout\Constraint;
use PhpTui\Tui\Style\Style;
use PhpTui\Tui\Widget\Borders;
use PhpTui\Tui\Widget\HorizontalAlignment;

class CharacterStatsView extends View
{
    private TableWidget $table;

    protected static int $tab = 0;

    public function run(): void
    {
        while(true) {
            while (null !== $event = $this->getTerminalEngine()->getTerminal()->events()->next()) {

                if (MainTabComponent::run($this, $event)) break 2;

                if ($event  instanceof CodedKeyEvent and $event->code === KeyCode::Up) {
                    $selectedIndex = $this->table->state->selected;
                    if ($selectedIndex > 0) {
                        $this->table->select(--$selectedIndex);
                        $this->getTerminalEngine()->setCurrentCharacter($selectedIndex);
                    }
                    $this->renderWidget(BlockComponent::create("Character Statistics", $this->table), self::$tab);
                }

                if ($event  instanceof CodedKeyEvent and $event->code === KeyCode::Down) {
                    $rowCount = count($this->table->rows) - 1;
                    $selectedIndex = $this->table->state->selected;
                    if ($selectedIndex < $rowCount) {
                        $this->table->select(++$selectedIndex);
                        $this->getTerminalEngine()->setCurrentCharacter($selectedIndex);
                    }
                    $this->renderWidget(BlockComponent::create("Character Statistics", $this->table), self::$tab);
                }

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
                "{$char->getHp()}/{$char->getHpMax()}",
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
        ;
        if($this->getTerminalEngine()->getCurrentCharacter() == null) {
            $this->table->select(0);
            $this->getTerminalEngine()->setCurrentCharacter(0);
        } else {
            foreach ($this->getTerminalEngine()->getCharacterList() as $id => $character) {
                if($character === $this->getTerminalEngine()->getCurrentCharacter()) {
                    $this->table->select($id);
                }
            }
        }
        $this->table->rows = array_values($charRows);
        $this->renderWidget(BlockComponent::create("Character-Auswahl",$this->table),self::$tab);

        return $this;
    }

}
