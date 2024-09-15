<?php

namespace Btinet\Rpg\Scene\Mansion;

use Btinet\Rpg\Scene\AbstractScene;
use Btinet\Rpg\Scene\Scene;
use Btinet\Rpg\Scene\SceneLibrary;
use Btinet\Rpg\System\Out;

class EntryHallScene extends AbstractScene
{


    public function __construct()
    {
        parent::__construct("Eingangshalle");
    }

    public function configureScene(): array
    {
        return [
            Scene::links->name => DiningHallScene::class,
        ];
    }

    public function loop(): void
    {
        Out::printHeading("Du stehst in der Eingangshalle. Nach Norden und Osten befindet sich jeweils eine Tür.");

        foreach ($this->getTargetScenes() as $target => $targetScene) {
            $scene = SceneLibrary::get($targetScene);
            Out::printLn("$target: $scene");
        }

        while (true) {
            $input = readline("Was willst du tun? ");
            if(str_contains($input,"gehe")) {
                foreach ($this->getTargetScenes() as $target => $targetScene) {
                    if(str_contains($input,$target)) {
                        SceneLibrary::get($targetScene)->loop();
                        break;
                    } else {
                        Out::printLn("Wohin gehen?");
                        sleep(1);
                    }
                }
            }
        }
    }
}