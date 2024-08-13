<?php

namespace Btinet\Rpg\TerminalMenu;

use Btinet\Rpg\System\Out;
use Closure;
use JetBrains\PhpStorm\NoReturn;

class TerminalMenu
{
    private string $title;

    private string $key;

    /**
     * @var array<Closure>
     */
    private array $actions = [];

    private ?TerminalMenu $parentMenu = null;

    /**
     * @var array<TerminalMenu>
     */
    private array $children = [];

    /**
     * @param string $title
     * @param string $key
     * @param TerminalMenu|null $parentMenu
     * @param TerminalMenu[] $children
     */
    public function __construct
    (
        string $title,
        string $key,
        ?TerminalMenu $parentMenu = null,
        array $children = [],
    )
    {
        $this->title = $title;
        $this->key = $key;
        $this->parentMenu = $parentMenu;
        $this->children = $children;
    }

    public function addAction(Closure $action): void
    {
        $this->actions[] = $action;
    }

    #[NoReturn]
    public function render(): void
    {
        Out::printHeading($this->title);

        foreach ($this->children as $child) {
            if($child instanceof TerminalMenu){
                Out::printLn($child->getKey());
            }
        }

        if($this->hasParent()) {
            Out::printLn($this->parentMenu->getKey());
        }

        while(true){
            $input = readline("Frage: ");

            if($this->parentMenu != null && strtolower($input) == $this->parentMenu->getKey()) {
                $this->parentMenu->render();
            }

            if($this->hasChildren()) {
                foreach ($this->children as $child) {
                    if($child instanceof TerminalMenu){
                        if(strtolower($input) == $child->getKey()) {
                            if($child->hasChildren()) {
                                $child->render();
                            } else {
                                $child->runActions();
                            }
                        }
                    }
                }

            }

           if(strtolower($input) == 'exit') {
               exit(0);
           }
        }
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function setParentMenu(?TerminalMenu $parentMenu): void
    {
        $this->parentMenu = $parentMenu;
    }

    public function getParentMenu(): ?TerminalMenu
    {
        return $this->parentMenu;
    }

    public function addChild(TerminalMenu $menu): void
    {
        $this->children[] = $menu;
        $menu->setParentMenu($this);
    }

    private function runActions(): void
    {
        foreach($this->actions as $action) {
            call_user_func($action);
        }
    }

    public function hasParent(): bool
    {
        return (bool) $this->parentMenu;
    }

    public function hasChildren(): bool
    {
        return !(count($this->children) == 0);
    }

}