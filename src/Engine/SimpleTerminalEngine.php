<?php

namespace Btinet\Rpg\Engine;

use Btinet\Rpg\Character\Character;
use Btinet\Rpg\Character\Gear\Gear;
use Btinet\Rpg\Character\Weapon\Weapon;
use Btinet\Rpg\Config\ConfigInterface;
use Btinet\Rpg\Monster\Monster;
use Btinet\Rpg\System\Out;
use Btinet\Rpg\TerminalMenu\TerminalMenu;
use Btinet\Rpg\TerminalMenu\View\AbstractMenuView;
use Error;
use JetBrains\PhpStorm\NoReturn;
use TypeError;

class SimpleTerminalEngine
{

    /**
     * @var array<Character>
     */
    private array $characterList;

    /**
     * @var Character|null
     */
    private ?Character $currentCharacter = null;

    /**
     * @var array<Weapon>
     */
    private array $weaponList;

    /**
     * @var array<Gear>
     */
    private array $gearList;

    /**
     * @var array<Monster>
     */
    private array $monsterList;

    /**
     * @var Monster|null
     */
    private ?Monster $currentMonster = null;

    private TerminalMenu $mainMenu;

    public function __construct(ConfigInterface $config, string $title, string $key)
    {
        $this->characterList = $config::characterLibrary();
        $this->weaponList = $config::weaponLibrary();
        $this->gearList = $config::gearLibrary();
        $this->monsterList = $config::monsterLibrary();

        $this->mainMenu = new TerminalMenu($title, $key);

        foreach ($config::menuViewLibrary() as $menuSet)
        {
            if(class_exists($class = $menuSet[0])) {
                $subMenu = new $class($menuSet[1], $menuSet[2], $this);
                $this->mainMenu->addChildren($subMenu->getMenu());
            }
        }
    }

    /**
     * Speichert die aktuelle Sitzung
     * @return array zu speichernde Daten
     */
    public function __serialize(): array
    {
        return [
            $this->characterList,
            $this->currentCharacter,
            $this->gearList,
            $this->weaponList,
            $this->monsterList,
            $this->currentMonster,
        ];
    }

    /**
     * Lädt die letzte Sitzung
     * @param array $data zu ladende Daten
     * @return void
     */
    public function __unserialize(array $data): void
    {
        try {
            list(
                $this->characterList,
                $this->currentCharacter,
                $this->gearList,
                $this->weaponList,
                $this->monsterList,
                $this->currentMonster,
                ) = $data;
        } catch (TypeError|Error $exception) {
            Out::printAlert($exception->getMessage());
        }
    }

    /**
     * @return Character[]
     */
    public function getCharacterList(): array
    {
        return $this->characterList;
    }

    /**
     * @return Character|null
     */
    public function getCurrentCharacter(): ?Character
    {
        return $this->currentCharacter;
    }

    /**
     * @param int $index
     */
    public function setCurrentCharacter(int $index): void
    {
        $this->currentCharacter = $this->getCharacter($index);
    }

    public function getCharacter(int $index): Character
    {
        return $this->characterList[$index];
    }

    public function addCharacter($character): void
    {
        $this->characterList[] = $character;
    }

    /**
     * @return Weapon[]
     */
    public function getWeaponList(): array
    {
        return $this->weaponList;
    }

    /**
     * @return Gear[]
     */
    public function getGearList(): array
    {
        return $this->gearList;
    }

    /**
     * @return Monster[]
     */
    public function getMonsterList(): array
    {
        return $this->monsterList;
    }

    public function setCurrentMonster(int $selectedIndex): void
    {
        $this->currentMonster = $this->getMonster($selectedIndex);
    }

    public function getCurrentMonster(): ?Monster
    {
        return $this->currentMonster;
    }

    private function getMonster($index)
    {
        return $this->monsterList[$index];
    }

    public function getMainMenu(): TerminalMenu
    {
        return $this->mainMenu;
    }

    #[NoReturn]
    public function start(): void
    {
        $this->mainMenu->render();
    }

}