<?php

namespace Btinet\Rpg\View;

interface ViewInterface
{
    /**
     * Lege hier deine Widgets an. Nutze am besten Klassenattribute, um zwischendurch darauf zugreifen zu können.
     */
    public function setup(): void;

    /**
     * Implementiere hier die While-Schleife in Kombination mit STDIN
     */
    public function run(): void;
}