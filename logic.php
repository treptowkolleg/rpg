<?php

use Btinet\Rpg\Character\Character;
use Btinet\Rpg\Character\Predefined\Cloud;
use Btinet\Rpg\Character\Weapon\BusterSword;
use Btinet\Rpg\System\Out;
use Btinet\Rpg\System\TextColor;
use PhpTui\Term\Event\CharKeyEvent;
use PhpTui\Term\Event\CodedKeyEvent;
use PhpTui\Term\Event\FunctionKeyEvent;
use PhpTui\Term\KeyCode;
use PhpTui\Term\Terminal;
use PhpTui\Tui\Bridge\PhpTerm\PhpTermBackend;
use PhpTui\Tui\DisplayBuilder;
use PhpTui\Tui\Extension\Core\Widget\BlockWidget;
use PhpTui\Tui\Extension\Core\Widget\GridWidget;
use PhpTui\Tui\Extension\Core\Widget\ParagraphWidget;
use PhpTui\Tui\Extension\Core\Widget\Table\TableCell;
use PhpTui\Tui\Extension\Core\Widget\Table\TableRow;
use PhpTui\Tui\Extension\Core\Widget\TableWidget;
use PhpTui\Tui\Extension\Core\Widget\TabsWidget;
use PhpTui\Tui\Layout\Constraint;
use PhpTui\Tui\Style\Style;
use PhpTui\Tui\Text\Line;
use PhpTui\Tui\Text\Span;
use PhpTui\Tui\Text\Text;
use PhpTui\Tui\Text\Title;
use PhpTui\Tui\Widget\Borders;
use PhpTui\Tui\Widget\Direction;

require 'vendor/autoload.php';

/**
 * @var $chars array<Character>
 */
$chars = [
    new Cloud()
    ];

$charRows = [];
foreach ($chars as $char) {
    $charRows[] = TableRow::fromStrings(
        $char,
        $char->getHp(),
        $char->getAp(),
        $char->getDp(),
        $char->getVp(),
        $char->getMoodPoints(),
        $char->getExp(),
        $char->getLevel(),
        $char->getWeapon(0) ?? '',
        $char->getGear(0) ?? '',
    );
}

/*
for($i = 1; $i <= 40; $i++) {
    $testChar->setExp(exp($i));
    Out::printListLn("EXP: {$testChar->getExp()}",$testChar->getLevel(), color: TextColor::lightBlue);
}*/
$inputLine = ParagraphWidget::fromString("Eingabe")->style(Style::default()->blue()->onWhite());

$table = TableWidget::default()
    ->widths(
        Constraint::percentage(10),
        Constraint::percentage(10),
        Constraint::percentage(10),
        Constraint::percentage(10),
        Constraint::percentage(10),
        Constraint::percentage(10),
        Constraint::percentage(10),
        Constraint::percentage(10),
        Constraint::percentage(10),
        Constraint::percentage(10),
    )
    ->highlightStyle(Style::default()->white()->onBlue())
    ->header(
        TableRow::fromStrings(
            'Character',
            'HP',
            'Attack',
            'Defense',
            'Vitality',
            'Mood',
            'EXP',
            'Level',
            '1. Waffe',
            '1. Rüstung',
        )->height(1)->bottomMargin(1)
    )
    ->select(0)
;

$table->rows = array_values($charRows);

$tabs = TabsWidget::default()->style(Style::default()->lightBlue()->onBlack())
    ->titles(
        Line::fromString('(a) Datei'),
        Line::fromString('(b) Stats'),
        Line::fromString('(c) Inventar'),
        Line::fromString('(d) Gegner'),
    )
    ->select(1)
    ->highlightStyle(Style::default()->white()->onLightBlue())
    ->divider(Span::fromString('|'));

$stats = GridWidget::default()
    ->direction(Direction::Vertical)
    ->constraints(
        Constraint::percentage(10),
        Constraint::percentage(90),
    )->widgets(
        $tabs,
        BlockWidget::default()->style(Style::default()->lightBlue()->onBlack())->titles(Title::fromString("Character Statistics"))->borders(Borders::ALL)->widget(
            $table,
        )
    )
;

$terminal = Terminal::new();

$display = DisplayBuilder::default(PhpTermBackend::new($terminal))->build();
$display->clear();
$display->draw($stats);

function any_key($prompt = null)
{
    $prompt = $prompt ? $prompt : "";
    readline_callback_handler_install($prompt, function() {});
}
any_key();

while (true) {

    $keystroke = stream_get_contents(STDIN);

    if($keystroke){
        $inputLine->text = Text::fromString("Eingabe war: $keystroke");
        $display->clear();
        $display->draw($stats);
    }
//    $input = strtolower(readline());

    if($keystroke === "exit") {
        $display->clear();
        exit(0);
    }
    if($keystroke == "a") {
        $tabs->select(0);
        $display->clear();
        $display->draw($tabs);
    }
    if($keystroke == "b") {
        $tabs->select(1);
        $display->clear();
        $display->draw($stats);
    }
    if($keystroke == "c") {
        $tabs->select(2);
        $display->clear();
        $display->draw($tabs);
    }

    if($keystroke == "d") {
        $tabs->select(3);
        $display->clear();
        $display->draw($tabs);
    }

    if($keystroke == "-") {
        $selectedIndex = $table->state->selected;
        if($selectedIndex > 0) {
            $table->select(--$selectedIndex);
        }
        $display->clear();
        $display->draw($stats);
    }

    if($keystroke == "+") {
        $rowCount = count($table->rows)-1;
        $selectedIndex = $table->state->selected;
        if($selectedIndex < $rowCount) {
            $table->select(++$selectedIndex);
        }
        $display->clear();
        $display->draw($stats);
    }
}


/*Out::printLn("");

Out::printListLn("HP",$testChar->getHp(), color: TextColor::lightBlue);
Out::printListLn("Attack",$testChar->getAp(), color: TextColor::green);
Out::printListLn("Defense",$testChar->getDp(), color: TextColor::red);
Out::printListLn("Vitality",$testChar->getVp(), color: TextColor::cyan);
Out::printListLn("Mood",$testChar->getMoodPoints(), color: TextColor::purple);*/


//$gameEngine = new GameEngine();

//$gameEngine->addPlayer(PlayerPosition::left,UserCharacterFactory::Sigmar());
//$gameEngine->addPlayer(PlayerPosition::right,UserCharacterFactory::Archaon());

//$gameEngine->start();


