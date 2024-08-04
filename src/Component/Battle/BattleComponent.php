<?php

namespace Btinet\Rpg\Component\Battle;

use Btinet\Rpg\Component\BlockComponent;
use Btinet\Rpg\Engine\TerminalEngine;
use PhpTui\Tui\Extension\Core\Widget\GridWidget;
use PhpTui\Tui\Extension\Core\Widget\ParagraphWidget;
use PhpTui\Tui\Layout\Constraint;
use PhpTui\Tui\Widget\Direction;
use PhpTui\Tui\Widget\HorizontalAlignment;
use PhpTui\Tui\Widget\Widget;

class BattleComponent
{
    protected TerminalEngine $engine;

    /**
     * @param TerminalEngine $engine
     */
    public function __construct(TerminalEngine $engine)
    {
        $this->engine = $engine;
    }

    /**
     * @return TerminalEngine
     */
    public function getEngine(): TerminalEngine
    {
        return $this->engine;
    }

    public function default(): Widget
    {
        return GridWidget::default()
            ->direction(Direction::Vertical)
            ->constraints(
                Constraint::length(3),
                Constraint::length(100),
            )
            ->widgets(
                BlockComponent::create("Kampfarena",ParagraphWidget::fromString("")->alignment(HorizontalAlignment::Left)),
                GridWidget::default()
                    ->direction(Direction::Horizontal)
                    ->constraints(
                        Constraint::length(30),
                        Constraint::length(30),
                        Constraint::length(30),
                    )
                    ->widgets(
                        BlockComponent::create("Status",ParagraphWidget::fromString("Links")->alignment(HorizontalAlignment::Left)),
                        BlockComponent::create("Fähigkeiten",ParagraphWidget::fromString("Links")->alignment(HorizontalAlignment::Left)),
                        BlockComponent::create("Log",ParagraphWidget::fromString("Links")->alignment(HorizontalAlignment::Left)),
                    )
            );
    }

}
