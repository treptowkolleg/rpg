<?php

namespace Btinet\Rpg\View;

use Btinet\Rpg\Component\MainTabComponent;

class ItemView extends View
{

    /**
     * @return ViewInterface
     */
    public function setup(): ViewInterface
    {
        // TODO: Implement setup() method.
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