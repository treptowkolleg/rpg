<?php

namespace Btinet\Rpg\Scene;

interface SceneInterface
{
    public function configureScene(): array;

    public function loop(): void;

}