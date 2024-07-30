<?php

namespace Btinet\Rpg\View;

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
        if(file_exists(asset_dir. 'images/tifa.jpg')) {
            $this->renderWidget(
                GridWidget::default()
                    ->direction(Direction::Vertical)
                    ->constraints(
                        Constraint::percentage(60),
                        Constraint::percentage(40),
                    )
                ->widgets(
                    GridWidget::default()
                        ->direction(Direction::Horizontal)
                        ->constraints(
                            Constraint::percentage(20),
                            Constraint::percentage(30),
                            Constraint::percentage(30),
                            Constraint::percentage(20),
                        )
                        ->widgets(
                            $this->getTerminalEngine()->getCurrentCharacter()->getAvatar(),
                            ParagraphWidget::fromString("Links")->alignment(HorizontalAlignment::Center),
                            ParagraphWidget::fromString("rechts")->alignment(HorizontalAlignment::Center),
                            $this->getTerminalEngine()->getCurrentMonster()->getAvatar(),
                        )
                )
                ,
                2);
        } else {
            echo "Bild nicht gefunden!";
        }

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