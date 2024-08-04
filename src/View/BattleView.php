<?php

namespace Btinet\Rpg\View;

use Btinet\Rpg\Component\Battle\BattleComponent;
use Btinet\Rpg\Component\BlockComponent;
use Btinet\Rpg\System\BackgroundColor;
use Btinet\Rpg\System\Out;
use Btinet\Rpg\System\TextColor;
use PhpTui\Term\Event\CodedKeyEvent;
use PhpTui\Term\KeyCode;
use PhpTui\Tui\Extension\Core\Widget\ParagraphWidget;

class BattleView extends View
{

    protected static int $tab = 4;

    protected BattleComponent $battleComponent;

    /**
     * Lege hier deine Widgets an. Nutze am besten Klassenattribute, um zwischendurch darauf zugreifen zu können.
     */
    public function setup(): ViewInterface
    {
        if(!$this->getTerminalEngine()->getCurrentCharacter() or !$this->getTerminalEngine()->getCurrentMonster()) {
            $this->notify("action:deny","character and monster select needed for battle!");
            echo "character and monster select needed for battle!\n";
            $this->getTerminalEngine()->renderView(CharacterStatsView::class);
        }

        $this->battleComponent = new BattleComponent($this->getTerminalEngine());

        $this->renderWidget(
            $this->battleComponent->default()
            ,self::$tab);

        return $this;
    }

    /**
     * Implementiere hier die While-Schleife in Kombination mit STDIN
     */
    public function run(): void
    {
        while(true) {
            while (null !== $event = $this->getTerminalEngine()->getTerminal()->events()->next()) {

                if ($event  instanceof CodedKeyEvent and $event->code === KeyCode::Up) {
                    // TODO: Auswahl der Fähigkeiten
                }

                if ($event  instanceof CodedKeyEvent and $event->code === KeyCode::Down) {
                    // TODO: Auswahl der Fähigkeiten
                }

                if ($event  instanceof CodedKeyEvent and $event->code === KeyCode::Delete) {
                    $this->notify("action:system","shutdown");
                    $this->getTerminalEngine()->getDisplay()->clear();
                    Out::printAlert("Spiel wird beendet...", TextColor::lightBlue,BackgroundColor::black);
                    sleep(3);
                    $this->getTerminalEngine()->getDisplay()->clear();
                    break 2;
                }
            }
        }
    }
}