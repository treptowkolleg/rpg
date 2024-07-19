<?php

namespace Btinet\Rpg\View;

use Btinet\Rpg\Component\TabComponent;
use Btinet\Rpg\Engine\TerminalEngine;
use PhpTui\Tui\Extension\Core\Widget\GridWidget;
use PhpTui\Tui\Extension\Core\Widget\TableWidget;
use PhpTui\Tui\Layout\Constraint;
use PhpTui\Tui\Widget\Direction;
use PhpTui\Tui\Widget\Widget;
use SplObserver;
use SplSubject;

abstract class View implements ViewInterface, SplSubject
{

    private TerminalEngine $terminalEngine;
    private array $observers = [];

    /**
     * @param TerminalEngine $terminalEngine
     */
    public function __construct(TerminalEngine $terminalEngine)
    {
        $this->terminalEngine = $terminalEngine;
        $this->observers = $terminalEngine->getObservers();
    }

    private function initEventGroup(string $event = "*"): void
    {
        if (!isset($this->observers[$event])) {
            $this->observers[$event] = [];
        }
    }

    private function getEventObservers(string $event = "*"): array
    {
        $this->initEventGroup($event);
        $group = $this->observers[$event];
        $all = $this->observers["*"];

        return array_merge($group, $all);
    }

    public function attach(SplObserver $observer, string $event = "*"): void
    {
        $this->initEventGroup($event);

        $this->observers[$event][] = $observer;
    }

    public function detach(SplObserver $observer, string $event = "*"): void
    {
        foreach ($this->getEventObservers($event) as $key => $s) {
            if ($s === $observer) {
                unset($this->observers[$event][$key]);
            }
        }
    }

    public function notify(string $event = "*", $data = null): void
    {
        foreach ($this->getEventObservers($event) as $observer) {
            $observer->update($this, $event, $data);
        }
    }

    /**
     * @return TerminalEngine
     */
    public function getTerminalEngine(): TerminalEngine
    {
        return $this->terminalEngine;
    }

    public function input(): false|string
    {
        return $this->terminalEngine->receiveInput();
    }

    public function clear(): self
    {
        $this->terminalEngine->getDisplay()->clear();
        return $this;
    }

    public function draw(Widget $widget): self
    {
        $this->terminalEngine->getDisplay()->draw($widget);
        return $this;
    }

    public function renderWidget(Widget $widget, $select = 0): self
    {
        $grid = GridWidget::default()
            ->direction(Direction::Vertical)
            ->constraints(
                Constraint::percentage(10),
                Constraint::percentage(90),
            )
            ->widgets(
                TabComponent::create($select),
                $widget
            )
        ;
        $this->clear()->draw($grid);
        return $this;
    }

}