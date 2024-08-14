<?php

namespace Btinet\Rpg\TerminalMenu;

use Closure;

/**
 * Im Gegensatz zu Menüs haben Menüpunkte Aktionen, die ausgeführt werden können.
 * Menüpunkte haben keine weiteren Unterpunkte oder Menüs.
 */
class TerminalMenuItem extends AbstractTerminalMenu
{

    /**
     * @var array<Closure>
     */
    protected array $actions = [];

    public function __construct
    (
        string                $title,
        string                $key,
        ?AbstractTerminalMenu $parentMenu = null,
    )
    {
        parent::__construct($title, $key, $parentMenu);
    }

    /**
     * @param Closure $action
     * @return void
     */
    public function addAction(Closure $action): void
    {
        $this->actions[] = $action;
    }

    /**
     * @return void
     */
    public function runActions(): void
    {
        foreach($this->actions as $action) {
            call_user_func($action);
        }
    }

}