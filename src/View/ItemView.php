<?php

namespace Btinet\Rpg\View;

use Btinet\Rpg\Component\BlockComponent;
use Btinet\Rpg\Component\MainTabComponent;
use PhpTui\Tui\Canvas\Marker;
use PhpTui\Tui\Color\AnsiColor;
use PhpTui\Tui\Extension\Core\Shape\MapResolution;
use PhpTui\Tui\Extension\Core\Shape\MapShape;
use PhpTui\Tui\Extension\Core\Shape\SpriteShape;
use PhpTui\Tui\Extension\Core\Widget\CanvasWidget;
use PhpTui\Tui\Extension\Core\Widget\GridWidget;
use PhpTui\Tui\Extension\Core\Widget\ParagraphWidget;
use PhpTui\Tui\Extension\ImageMagick\Shape\ImageShape;
use PhpTui\Tui\Extension\ImageMagick\Widget\ImageWidget;
use PhpTui\Tui\Layout\Constraint;
use PhpTui\Tui\Position\FloatPosition;
use PhpTui\Tui\Position\Position;
use PhpTui\Tui\Widget\Direction;
use PhpTui\Tui\Widget\HorizontalAlignment;

class ItemView extends View
{

    /**
     * @return ViewInterface
     */
    public function setup(): ViewInterface
    {
        $currentCharacter = $this->getTerminalEngine()->getCurrentCharacter();
        $title = "Kaufe Gegenstände für $currentCharacter";
        $this->renderWidget(
            GridWidget::default()
                ->direction(Direction::Vertical)
                ->constraints(
                    Constraint::length(3),
                    Constraint::length(100),
                )
            ->widgets(
                BlockComponent::create("Shop",ParagraphWidget::fromString($title)->alignment(HorizontalAlignment::Left)),
                GridWidget::default()
                    ->direction(Direction::Horizontal)
                    ->constraints(
                        Constraint::length(30),
                        Constraint::length(30),
                        Constraint::length(30),
                    )
                    ->widgets(
                        BlockComponent::create("Waffen",ParagraphWidget::fromString("Links")->alignment(HorizontalAlignment::Left)),
                        BlockComponent::create("Rüstung",ParagraphWidget::fromString("Links")->alignment(HorizontalAlignment::Left)),
                        BlockComponent::create("Items",ParagraphWidget::fromString("Links")->alignment(HorizontalAlignment::Left)),
                    )
            )
            ,
            2
        );

        return $this;
    }

    /**
     *
     */
    public function run(): void
    {
        while (true) {
            while (null !== $event = $this->getTerminalEngine()->getTerminal()->events()->next()) {
                if(MainTabComponent::run($this,$event)) break 2;
            }
        }
    }
}