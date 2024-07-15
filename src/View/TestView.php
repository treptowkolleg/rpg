<?php

namespace Btinet\Rpg\View;

use PhpTui\Tui\Extension\Core\Widget\ParagraphWidget;

class TestView extends View
{

    public function run(): void
    {
        $this->clear()->draw(ParagraphWidget::fromString("a für View, b für CharView"));
        while (true) {
            $input = $this->input();
            if($input === "a") {
                $this->renderWidget(ParagraphWidget::fromString("TestView"));
            }

            if($input === "b") {
                $this->getTerminalEngine()->renderView(CharacterStatsView::class);
                break;
            }
        }
    }

    /**
     * Lege hier deine Widgets an. Nutze am besten Klassenattribute, um zwischendurch darauf zugreifen zu können.
     */
    public function setup(): void
    {
        // TODO: Implement setup() method.
    }
}