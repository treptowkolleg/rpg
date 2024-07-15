<?php

namespace Btinet\Rpg\View;

use Btinet\Rpg\Engine\TerminalEngine;
use PhpTui\Tui\Widget\Widget;

abstract class View implements ViewInterface
{

    private TerminalEngine $terminalEngine;

    /**
     * @param TerminalEngine $terminalEngine
     */
    public function __construct(TerminalEngine $terminalEngine)
    {
        $this->terminalEngine = $terminalEngine;
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

    public function renderWidget(Widget $widget): self
    {
        $this->clear()->draw($widget);
        return $this;
    }

}