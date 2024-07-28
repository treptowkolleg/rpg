<?php

namespace Btinet\Rpg\View;

use Btinet\Rpg\Component\BlockComponent;
use Btinet\Rpg\Component\MainTabComponent;
use PhpTui\Tui\Extension\Core\Widget\BlockWidget;
use PhpTui\Tui\Extension\Core\Widget\CompositeWidget;
use PhpTui\Tui\Extension\Core\Widget\ParagraphWidget;
use PhpTui\Tui\Extension\Core\Widget\Scrollbar\ScrollbarState;
use PhpTui\Tui\Extension\Core\Widget\ScrollbarWidget;
use PhpTui\Tui\Extension\ImageMagick\Widget\ImageWidget;
use PhpTui\Tui\Text\Title;
use PhpTui\Tui\Widget\Borders;
use PhpTui\Tui\Widget\Widget;

class TestView extends View
{
    private ScrollbarState $scrollbarState;
    private ScrollbarWidget $scrollbar;
    private ParagraphWidget $content;
    private Widget $block;

    protected static int $tab = 1;

    public function run(): void
    {
        while (true) {
            while (null !== $event = $this->getTerminalEngine()->getTerminal()->events()->next()) {
                if(MainTabComponent::run($this,$event)) break 2;
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
        ,self::$tab);
        return $this;
    }
}