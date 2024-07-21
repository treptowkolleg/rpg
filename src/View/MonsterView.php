<?php

namespace Btinet\Rpg\View;

use Btinet\Rpg\Component\BlockComponent;
use Btinet\Rpg\Component\MainTabComponent;
use PhpTui\Tui\Extension\Core\Widget\CompositeWidget;
use PhpTui\Tui\Extension\Core\Widget\ParagraphWidget;
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
            $charRows[] = TableRow::fromStrings(
                $char,
                "{$char->getHp()}/{$char->getHpMax()}",
                $char->getAp(),
                $char->getDp(),
                $char->getVp(),
                $char->getHitRate(),
                $char->getExp(),
                $char->getLevel(),
            );
        }

        $this->table = TableWidget::default()
            ->widths(
                Constraint::percentage(20),
                Constraint::percentage(20),
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
                    'Name',
                    'HP',
                    'Attack',
                    'Defense',
                    'Vitality',
                    'Trefferquote',
                    'EXP',
                    'Level',
                )->height(1)->bottomMargin(1)
            )
        ;
        $this->table->rows = array_values($charRows);
        $this->renderWidget(BlockComponent::create("Monsterliste",$this->table),self::$tab);
        return $this;
    }

    public function run(): void
    {
        while (true) {
            $input = $this->input();
            if(MainTabComponent::run($this,$input)) break;
        }
    }

}
