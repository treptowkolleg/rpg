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
                Line::fromString('(a) Kampfmitglieder'),
                Line::fromString('(b) Ausrüstung'),
                Line::fromString('(c) Shop'),
                Line::fromString('(d) Gegner'),
                Line::fromString('Kampfarena'),
            )
            ->select($select)
            ->highlightStyle(Style::default()->white()->onLightBlue())
            ->divider(Span::fromString('|'));
    }

}