<?php

namespace Btinet\Rpg\TerminalMenu;

/**
 * Diese Klasse enthält die Gemeinsamkeiten von Menüs und Menüpunkten.
 * Beide dürfen einen Titel, eine Taste und ein übergeordnetes Menü haben.
 */
abstract class AbstractTerminalMenu
{
    protected string $title;

    protected string $key;

    protected ?TerminalMenu $parentMenu = null;

    /**
     * @param string $title
     * @param string $key
     * @param TerminalMenu|null $parentMenu
     */
    public function __construct
    (
        string                $title,
        string                $key,
        ?TerminalMenu $parentMenu,
    )
    {
        $this->title = $title;
        $this->key = $key;
        $this->parentMenu = $parentMenu;
    }

    /**
     * @return void
     */
    protected function clearView(): void
    {
        echo shell_exec('clear');
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param TerminalMenu|null $parentMenu
     * @return void
     */
    public function setParentMenu(?TerminalMenu $parentMenu): void
    {
        $this->parentMenu = $parentMenu;
    }

    /**
     * @return TerminalMenu|null
     */
    public function getParentMenu(): ?TerminalMenu
    {
        return $this->parentMenu;
    }

    /**
     * @return bool
     */
    public function hasParent(): bool
    {
        return (bool) $this->parentMenu;
    }

}