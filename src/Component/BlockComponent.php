<?php

namespace Btinet\Rpg\Component;

use PhpTui\Tui\Extension\Core\Widget\BlockWidget;
use PhpTui\Tui\Style\Style;
use PhpTui\Tui\Text\Title;
use PhpTui\Tui\Widget\Borders;
use PhpTui\Tui\Widget\Widget;

class BlockComponent
{

    public static function create(string $title, Widget $child): Widget
    {
        return BlockWidget::default()->style(Style::default()->lightBlue()->onBlack())->titles(Title::fromString($title))->borders(Borders::ALL)->widget(
            $child,
        );
    }

}
