<?php

namespace Btinet\Rpg\View;

use Btinet\Rpg\Component\BlockComponent;
use PhpTui\Term\Event\CodedKeyEvent;
use PhpTui\Term\KeyCode;
use PhpTui\Tui\Extension\Core\Widget\ParagraphWidget;

class BattleView extends View
{

    protected static int $tab = 4;

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

        $this->renderWidget(BlockComponent::create("Kampfarena", ParagraphWidget::fromString("Kampf beginnt!")),self::$tab);
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
            }
        }
    }
}