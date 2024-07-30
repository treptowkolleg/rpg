<?php

namespace Btinet\Rpg\View;

use Btinet\Rpg\Component\BlockComponent;
use Btinet\Rpg\Component\MainTabComponent;
use PhpTui\Term\Event\CharKeyEvent;
use PhpTui\Term\Event\CodedKeyEvent;
use PhpTui\Term\KeyCode;
use PhpTui\Tui\Extension\Core\Widget\CompositeWidget;
use PhpTui\Tui\Extension\Core\Widget\ParagraphWidget;
use PhpTui\Tui\Extension\Core\Widget\ScrollbarWidget;
use PhpTui\Tui\Extension\Core\Widget\Table\TableRow;
use PhpTui\Tui\Extension\Core\Widget\TableWidget;
use PhpTui\Tui\Layout\Constraint;
use PhpTui\Tui\Style\Style;
use PhpTui\Tui\Widget\Widget;

class MonsterView extends View
{

    protected static int $tab = 3;

    private Widget $block;
    private ParagraphWidget $content;
    private TableWidget $table;

    /**
     * @return ViewInterface
     */
    public function setup(): ViewInterface
    {
        $charRows = [];

        foreach ($this->getTerminalEngine()->getMonsterList() as $char) {

            $defeated = $char->isDefeated() ? 'ja' : 'nein';
            $stars = round($char->getLevel()/10);
            $starString = '';
            if ($stars <= 0) $stars = 1;
            for($i = 1; $i <= $stars; $i++) $starString .= '★';

            $charRows[] = TableRow::fromStrings(
                $char,
                "{$char->getHp()}/{$char->getHpMax()}",
                $char->getAp(),
                $char->getDp(),
                $char->getVp(),
                $char->getHitRate(),
                count($char->getAbilities()),
                $char->getExp(),
                $starString,
                $defeated
            );
        }

        $this->table = TableWidget::default()
            ->widths(
                Constraint::length(20),
                Constraint::length(12),
                Constraint::length(10),
                Constraint::length(10),
                Constraint::length(10),
                Constraint::length(20),
                Constraint::length(16),
                Constraint::length(10),
                Constraint::length(10),
                Constraint::length(10),
                Constraint::length(10),
            )
            ->highlightStyle(Style::default()->white()->onBlue())
            ->header(
                TableRow::fromStrings(
                    'Name',
                    'HP',
                    'Attack',
                    'Defense',
                    'Vitality',
                    'Trefferquote',
                    'Fähigkeiten',
                    'EXP',
                    'Level',
                    'erledigt?'
                )->height(1)->bottomMargin(1)
            )
        ;
        if($this->getTerminalEngine()->getCurrentMonster() == null) {
            $this->table->select(0);
            $this->getTerminalEngine()->setCurrentMonster(0);
        } else {
            foreach ($this->getTerminalEngine()->getMonsterList() as $id => $monster) {
                if($monster === $this->getTerminalEngine()->getCurrentMonster()) {
                    $this->table->select($id);
                }
            }
        }
        $this->table->rows = array_values($charRows);
        $this->renderWidget(
            BlockComponent::create("Monsterliste",$this->table),self::$tab
        );
        return $this;
    }

    public function run(): void
    {
        while(true){
            while (null !== $event = $this->getTerminalEngine()->getTerminal()->events()->next()) {

                if(MainTabComponent::run($this,$event, self::$tab)) break 2;

                if ($event  instanceof CodedKeyEvent and $event->code === KeyCode::Up) {
                    $selectedIndex = $this->table->state->selected;
                    if ($selectedIndex > 0) {
                        $this->table->select(--$selectedIndex);
                        $this->getTerminalEngine()->setCurrentMonster($selectedIndex);
                    }
                    $this->renderWidget(BlockComponent::create("Monsterliste",$this->table),self::$tab);
                }

                if ($event  instanceof CodedKeyEvent and $event->code === KeyCode::Down) {
                    $rowCount = count($this->table->rows) - 1;
                    $selectedIndex = $this->table->state->selected;
                    if ($selectedIndex < $rowCount) {
                        $this->table->select(++$selectedIndex);
                        $this->getTerminalEngine()->setCurrentMonster($selectedIndex);
                    }
                    $this->renderWidget(BlockComponent::create("Monsterliste",$this->table),self::$tab);
                }

                if ($event  instanceof CodedKeyEvent and $event->code === KeyCode::Tab) {
                    $this->notify("action:view","BattleView");
                    $this->getTerminalEngine()->renderView(BattleView::class);
                    break 2;
                }

            }
        }

    }

}
