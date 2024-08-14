<?php

namespace Btinet\Rpg\Engine;

use Btinet\Rpg\System\Out;
use Exception;

class FileEngine
{

    public static function saveGame($object): void
    {
        file_put_contents(save_dir. "dok.sav", serialize(clone $object));
    }

    public static function loadGame()
    {
        try {
            if(file_exists(save_dir. "dok.sav")) {
                return unserialize(file_get_contents(save_dir. "dok.sav"));
            }
            return null;
        } catch (Exception $e) {
            Out::printAlert("{$e->getMessage()}");
        }
        return null;
    }

}