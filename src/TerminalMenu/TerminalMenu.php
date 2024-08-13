<?php

namespace Btinet\Rpg\TerminalMenu;

use Btinet\Rpg\System\Out;

class TerminalMenu implements TerminalMenuInterface
{
    private string $title;

    private string $key;

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

    public function doAction(array $options = []): void
    {
        Out::printHeading($this->title);

        foreach ($this->children as $child) {
            if($child instanceof TerminalMenuInterface){
                Out::printLn($child->getKey());
            }
        }

        if($this->parentMenu) {
            Out::printLn($this->parentMenu->getKey());
        }

        while(true){
            $input = readline("Frage: ");

            if($this->parentMenu != null && strtolower($input) == $this->parentMenu->getKey()) {
                $this->parentMenu->doAction($options);
            }

            if($this->children) {
                foreach ($this->children as $child) {
                    if($child instanceof TerminalMenuInterface){
                        if(strtolower($input) == $child->getKey()) {
                            $child->doAction($options);
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

}