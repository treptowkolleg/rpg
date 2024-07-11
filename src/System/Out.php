<?php

namespace Btinet\Rpg\System;

class Out
{

    /**
     * Gibt Text MIT Zeilenumbruch aus.
     * @param string $text Text, der ausgegeben werden soll.
     * @param TextColor $color Textfarbe (Standard ist weiß)
     * @param BackgroundColor $background Hintergrundfarbe (Standard ist schwarz)
     */
    public static function printLn(string $text, TextColor $color = TextColor::white, BackgroundColor $background = BackgroundColor::black): void
    {
        echo sprintf("%s%s%s%s\n",self::setColor($color),self::setColor($background),$text,self::setColor('0'));
    }

    /**
     * Gibt Text OHNE Zeilenumbruch aus.
     * @param string $text Text, der ausgegeben werden soll.
     * @param TextColor $color Textfarbe (Standard ist weiß)
     * @param BackgroundColor $background Hintergrundfarbe (Standard ist schwarz)
     */
    public static function print(string $text, TextColor $color = TextColor::white, BackgroundColor $background = BackgroundColor::black): void
    {
        echo sprintf("%s%s%s%s",self::setColor($color),self::setColor($background),$text,self::setColor('0'));
    }

    public static function printAlert(string $text, BackgroundColor $background = BackgroundColor::red): void
    {
        $horizontalLine = '';
        for($i = 1; $i <= (strlen($text) + 4); $i++) $horizontalLine .= ' ';
        self::printLn($horizontalLine,TextColor::white,$background);
        self::printLn(  "  $text  ",TextColor::white,$background);
        self::printLn($horizontalLine,TextColor::white,$background);
        self::printLn("");
    }

    /**
     * Gibt Text als Überschrift MIT Zeilenumbruch und Leerzeile aus.
     * @param string $text Text, der ausgegeben werden soll.
     * @param TextColor $color Textfarbe (Standard ist weiß)
     * @param BackgroundColor $background Hintergrundfarbe (Standard ist schwarz)
     */
    public static function printHeading(string $text, TextColor $color = TextColor::white, BackgroundColor $background = BackgroundColor::black): void
    {
        $horizontalLine = '';
        for($i = 1; $i <= (strlen($text) + 4); $i++) $horizontalLine .= '#';
        self::printLn($horizontalLine, $color, $background);
        self::printLn("# $text #", $color, $background);
        self::printLn($horizontalLine, $color, $background);
        self::printLn("");
    }

    /**
     * Hilfsmethode, um Farben zu codieren.
     * @param string|TextColor|BackgroundColor $color Farbcode
     * @return string codierter Farbcode
     */
    private static function setColor(string|TextColor|BackgroundColor $color): string
    {
        if($color instanceof TextColor || $color instanceof BackgroundColor) {
            return "\033[{$color->value}m";
        } else {
            return "\033[{$color}m";
        }
    }



}