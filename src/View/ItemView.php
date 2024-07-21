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
            $input = $this->input();
            if(MainTabComponent::run($this,$input)) break;
        }
    }
}