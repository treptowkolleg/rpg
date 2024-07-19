<?php

namespace Btinet\Rpg\View;

use Btinet\Rpg\Component\BlockComponent;
use PhpTui\Tui\Extension\Core\Widget\BlockWidget;
use PhpTui\Tui\Extension\Core\Widget\CompositeWidget;
use PhpTui\Tui\Extension\Core\Widget\ParagraphWidget;
use PhpTui\Tui\Extension\Core\Widget\Scrollbar\ScrollbarState;
use PhpTui\Tui\Extension\Core\Widget\ScrollbarWidget;
use PhpTui\Tui\Extension\ImageMagick\Widget\ImageWidget;
use PhpTui\Tui\Text\Title;
use PhpTui\Tui\Widget\Borders;

class TestView extends View
{
    private ScrollbarState $scrollbarState;
    private ScrollbarWidget $scrollbar;
    private ParagraphWidget $content;
    private \PhpTui\Tui\Widget\Widget $block;

    public function run(): void
    {
        while (true) {
            $input = $this->input();

            if($input === "a") {
                $this->notify("action:view","CharacterStatsView");
                $this->getTerminalEngine()->renderView(CharacterStatsView::class);
                break;
            }

            if($input === "b") {
                $this->renderWidget(CompositeWidget::fromWidgets(
                    $this->block = BlockComponent::create("Fenster 1",$this->content = ParagraphWidget::fromString($this->getTerminalEngine()->getCurrentCharacter()))
                )
                ,1);
            }
        }
    }

    /**
     * Lege hier deine Widgets an. Nutze am besten Klassenattribute, um zwischendurch darauf zugreifen zu können.
     */
    public function setup(): self
    {
        $this->renderWidget(CompositeWidget::fromWidgets(
            $this->block = BlockComponent::create("Fenster 1",$this->content = ParagraphWidget::fromString($this->getTerminalEngine()->getCurrentCharacter()))
        )
        ,1);
        return $this;
    }
}