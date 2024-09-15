<?php

namespace Btinet\Rpg\Scene;

use Btinet\Rpg\Scene\Mansion\EntryHallScene;

class SceneLibrary
{

    public static function get(string $sceneClass): string|AbstractScene
    {
        return class_exists($sceneClass) ? new $sceneClass : $sceneClass;
    }

}
