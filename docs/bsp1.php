<?php

$user = new User();

if($user instanceof Character) {
    echo "User ist Instanz der Klasse Character" . PHP_EOL;
}

if($user instanceof User) {
    echo "User ist Instanz der Klasse User" . PHP_EOL;
}

if($user instanceof TalkInterface) {
    echo "User ist Instanz des Interface TalkInterface" . PHP_EOL;
}

if($user instanceof BattleInterface) {
    echo "User ist Instanz des Interface BattleInterface" . PHP_EOL;
}

// Ausgabe:
// User ist Instanz der Klasse Character
// User ist Instanz der Klasse User
// User ist Instanz des Interface TalkInterface
// User ist Instanz des Interface BattleInterface