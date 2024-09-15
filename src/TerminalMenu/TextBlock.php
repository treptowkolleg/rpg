<?php

namespace Btinet\Rpg\TerminalMenu;

use Btinet\Rpg\System\Out;
use Btinet\Rpg\System\TextColor;

class TextBlock
{

    /**
     * @return void
     */
    private static function clearView(): void
    {
        echo shell_exec('clear');
    }

    public static function intro(): void
    {
        self::clearView();
        Out::printLn("Willkommen in den Dungeons unter dem Kolleg!", TextColor::lightPurple);
        Out::printLn("");
        Out::printLn("Versuche, alle Gegner zu besiegen, um das Spiel durchzuspielen.", TextColor::lightGreen);
        Out::printLn("Du kannst bereits besiegte Gegner erneut bekämpfen, um Erfahrungspunkte zu sammeln.", TextColor::lightGreen);
        Out::printLn("Nur so wird es dir gelingen, auch die schwersten Gegner zu besiegen.", TextColor::lightGreen);
        Out::printLn("Solltest du scheitern, werden dir allerdings auch Erfahrungspunkte abgezogen.", TextColor::lightGreen);
        Out::printLn("Wähle deine Gegner also weise.", TextColor::lightGreen);
        Out::printLn("");
        Out::print("Beende das Spiel mit ", TextColor::lightGreen);
        Out::print(">>bye<<", TextColor::lightPurple);
        Out::print(", ", TextColor::lightGreen);
        Out::print(">>exit<<", TextColor::lightPurple);
        Out::print(" oder ", TextColor::lightGreen);
        Out::print(">>quit<<", TextColor::lightPurple);
        Out::printLn(".", TextColor::lightGreen);
        Out::printLn("");
        readline("Enter drücken, um zu beginnen... ");
    }

}