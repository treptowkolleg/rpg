<?php

namespace Btinet\Rpg\Engine;

use Btinet\Rpg\System\Out;
use Exception;

class FileEngine
{

    public static function saveGame($object)
    {
        file_put_contents(save_dir. "dok.sav", serialize(clone $object));
    }

    public static function loadGame()
    {
        try {
            return unserialize(file_get_contents(save_dir. "dok.sav"));
        } catch (Exception $e) {
            Out::printAlert("{$e->getMessage()}");
        }
    }

}