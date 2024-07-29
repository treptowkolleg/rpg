<?php

namespace Btinet\Rpg\Engine;

use Btinet\Rpg\Character\Character;
use Btinet\Rpg\Character\Gear\Gear;
use Btinet\Rpg\Character\Weapon\Weapon;
use Btinet\Rpg\Config\ConfigInterface;
use Btinet\Rpg\Monster\Monster;
use Btinet\Rpg\System\Out;
use Btinet\Rpg\View\View;
use Error;
use PhpTui\Term\Terminal;
use PhpTui\Tui\Bridge\PhpTerm\PhpTermBackend;
use PhpTui\Tui\Display\Display;
use PhpTui\Tui\DisplayBuilder;
use PhpTui\Tui\Extension\ImageMagick\ImageMagickExtension;
use PhpTui\Tui\Widget\Widget;
use Serializable;
use SplObserver;
use SplSubject;
use TypeError;

class TerminalEngine implements Serializable
{

    private Terminal $terminal;
    private Display $display;

    /**
     * @var array<Character>
     */
    private array $characterList;

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

    // Here goes the actual Observer management infrastructure. Note that it's
    // not everything that our class is responsible for. Its primary business
    // logic is listed below these methods.

    /**
     * @var array
     */
    private array $observers = [];
    /**
     * @var Monster|mixed
     */
    private ?Monster $currentMonster = null;

    public function __construct(ConfigInterface $config)
    {
        $this->terminal = Terminal::new();
        $this->display = DisplayBuilder::default(PhpTermBackend::new($this->terminal))->addExtension(new ImageMagickExtension())->build();
        $this->display->clear();

        $this->characterList = $config::characterLibrary();
        $this->weaponList = $config::weaponLibrary();
        $this->gearList = $config::gearLibrary();
        $this->monsterList = $config::monsterLibrary();

        $this->observers["*"] = [];

        // Nicht unter Windows verfügbar (außer über WSL)
        readline_callback_handler_install("", function() {});
    }

    public function attach(SplObserver $observer, string $event = "*"): void
    {
       $this->observers[$event][] = $observer;
    }

    /**
     * @return array
     */
    public function getObservers(): array
    {
        return $this->observers;
    }

    /**
     * @return Terminal
     */
    public function getTerminal(): Terminal
    {
        return $this->terminal;
    }

    /**
     * @return Display
     */
    public function getDisplay(): Display
    {
        return $this->display;
    }

    /**
     * @param Widget $widget
     */
    public function draw(Widget $widget): void
    {
        $this->display->draw($widget);
    }

    public function renderView(string $viewClassName): void
    {
        if(class_exists($viewClassName)) {
            $viewObject = new $viewClassName($this);
            if($viewObject instanceof View) {
                $viewObject->setup()->run();
            }
        }
    }

    public function receiveInput(): bool|string
    {
        return stream_get_contents(STDIN);
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

    public function setCurrentMonster(int $selectedIndex)
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

    /**
     * @return string|null
     */
    public function serialize(): ?string
    {
        return serialize([
            $this->characterList,
            $this->currentCharacter,
            $this->gearList,
            $this->weaponList,
            $this->monsterList,
            $this->currentMonster,
        ]);
    }

    /**
     * @param string $data
     */
    public function unserialize($data)
    {
        $this->terminal = Terminal::new();
        $this->display = DisplayBuilder::default(PhpTermBackend::new($this->terminal))->build();
        $this->display->clear();

        // Nicht unter Windows verfügbar (außer über WSL)
        readline_callback_handler_install("", function() {});

        try {
            list(
                $this->characterList,
                $this->currentCharacter,
                $this->gearList,
                $this->weaponList,
                $this->monsterList,
                $this->currentMonster,
                ) = unserialize($data);
        } catch (TypeError|Error $exception) {
            Out::printAlert($exception->getMessage());
        }

    }

}
