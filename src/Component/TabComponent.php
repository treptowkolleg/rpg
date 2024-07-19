<?php

namespace Btinet\Rpg\Component;

use PhpTui\Tui\Extension\Core\Widget\TabsWidget;
use PhpTui\Tui\Style\Style;
use PhpTui\Tui\Text\Line;
use PhpTui\Tui\Text\Span;
use PhpTui\Tui\Widget\Widget;

class TabComponent
{

    public static function create(int $select): Widget
    {
        return TabsWidget::default()->style(Style::default()->lightBlue()->onBlack())
            ->titles(
                Line::fromString('(a) Character'),
                Line::fromString('(b) Ausrüstung'),
                Line::fromString('(c) Inventar'),
                Line::fromString('(d) Gegner'),
            )
            ->select($select)
            ->highlightStyle(Style::default()->white()->onLightBlue())
            ->divider(Span::fromString('|'));
    }

}