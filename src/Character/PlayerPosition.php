<?php

namespace Btinet\Rpg\Character;

enum PlayerPosition: string
{

    case one = "Spieler 1";
    case two = "Spieler 2";
    case three = "Spieler 3";
    case four = "Spieler 4";

    /**
     * Besser mit zwei Seiten (Gruppen)
     */
    case left = "links";
    case right = "rechts";

}