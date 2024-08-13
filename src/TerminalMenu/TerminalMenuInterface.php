<?php

namespace Btinet\Rpg\TerminalMenu;

interface TerminalMenuInterface
{

    public function doAction(array $options = []): void;

}