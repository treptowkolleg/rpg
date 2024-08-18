<?php

namespace Btinet\Rpg\TerminalMenu;

use Btinet\Rpg\System\BackgroundColor;
use Btinet\Rpg\System\Out;
use Btinet\Rpg\System\TextColor;
use JetBrains\PhpStorm\NoReturn;

/**
 * TerminalMenüs dürfen zusätzlich Unterelemente haben, die entweder Menüs oder Menüpunkte sind.
 * Außerdem zeigen Menüs Menüpunkte und über- sowie untergeordnete Menüs und Menüpunkte an.
 * Hier geschieht ebenfalls die Tastaturabfrage.
 */
class TerminalMenu extends AbstractTerminalMenu
{

    /**
     * @var array<AbstractTerminalMenu>
     */
    private array $children = [];

    /**
     * @param AbstractTerminalMenu[] $children
     */
    public function __construct(
        string                $title,
        string                $key,
        ?TerminalMenu $parentMenu = null,
        AbstractTerminalMenu ...$children,
    )
    {
        parent::__construct($title, $key, $parentMenu);
        $this->children = array_merge($this->children, $children);
        foreach ($children as $child) {
            $child->setParentMenu($this);
        }
    }

    /**
     * Füge Kind-Elemente hinzu.
     * @param AbstractTerminalMenu ...$items
     * @return void
     */
    public function addChildren(AbstractTerminalMenu ...$items): void
    {
        $this->children = array_merge($this->children, $items);
        foreach ($items as $item) {
            $item->setParentMenu($this);
        }
    }

    /**
     * @return array<AbstractTerminalMenu>
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    public function hasChildren(): bool
    {
        return !(count($this->children) == 0);
    }

    private function renderMenu(bool $clearBefore = false): void
    {
        if ($clearBefore) self::clearView();
        Out::printHeading($this->title, TextColor::blue);
        foreach ($this->children as $child) {
            if($child instanceof AbstractTerminalMenu){
                Out::printLn("{$child->getKey()}: {$child->getTitle()}",TextColor::blue);
            }
        }

        if($this->hasParent()) {
            Out::printLn("{$this->parentMenu->getKey()}: {$this->parentMenu->getTitle()}");
        }
    }

    /**
     * @return void
     */
    private function clearView(): void
    {
        echo shell_exec('clear');
    }

    #[NoReturn]
    public function render(): void
    {
        $this->renderMenu(true);

        while(true){
            $inputFound = false;
            $input = strtolower(readline("Aktion: "));

            if($this->parentMenu != null && $input == $this->parentMenu->getKey()) {
                $this->parentMenu->render();
            }

            if($this->hasChildren()) {
                foreach ($this->children as $child) {
                    if($child instanceof TerminalMenu) {
                        if($input == $child->getKey()) {
                            $inputFound = true;
                            if($child->hasChildren()) {
                                $child->render();
                            }
                        }
                    }
                    if ($child instanceof TerminalMenuItem && $input == $child->getKey()) {
                        $inputFound = true;
                        $child->runActions();
                        $this->renderMenu(true);
                    }
                }
            }

            if(in_array($input,['exit','bye','quit'])) {
                $this->clearView();
                Out::printAlert("Spiel wird beendet...", TextColor::blue, BackgroundColor::black);
                sleep(2);
                $this->clearView();
                exit(0);
            }

            if(!$inputFound) {
                Out::printLn("Befehl >>$input<< ist nicht verfügbar!",TextColor::lightRed);
                sleep(2);
                $this->renderMenu(true);
            }
        }
    }

}