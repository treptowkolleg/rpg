<?php

namespace Btinet\Rpg\Engine;

use Btinet\Rpg\Character\Character;
use Btinet\Rpg\Character\Gear\Gear;
use Btinet\Rpg\Character\Weapon\Weapon;
use Btinet\Rpg\Config\ConfigInterface;
use Btinet\Rpg\View\ViewInterface;
use PhpTui\Term\Terminal;
use PhpTui\Tui\Bridge\PhpTerm\PhpTermBackend;
use PhpTui\Tui\Display\Display;
use PhpTui\Tui\DisplayBuilder;
use PhpTui\Tui\Widget\Widget;

class TerminalEngine
{

    private Terminal $terminal;
    private Display $display;

    /**
     * @var array<Character>
     */
    private array $characterList;

    /**
     * @var array<Weapon>
     */
    private array $weaponList;

    /**
     * @var array<Gear>
     */
    private array $gearList;

    public function __construct(ConfigInterface $config)
    {
        $this->terminal = Terminal::new();
        $this->display = DisplayBuilder::default(PhpTermBackend::new($this->terminal))->build();
        $this->display->clear();

        $this->characterList = $config::characterLibrary();
        $this->weaponList = $config::weaponLibrary();
        $this->gearList = $config::gearLibrary();

        readline_callback_handler_install("", function() {});
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
            if($viewObject instanceof ViewInterface) {
                $viewObject->setup();
                $viewObject->run();
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

    public function getCharacter(int $index): Character
    {
        return $this->characterList[$index];
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

}
