<?php

namespace Btinet\Rpg\Scene;

use Btinet\Rpg\Character\Utility\LabelTrait;
use Stringable;

abstract class AbstractScene implements SceneInterface, Stringable
{

    use LabelTrait;

    /**
     * @var array<AbstractScene>
     */
    private array $targetScenes = [];

    public function __construct(string $sceneLabel)
    {
        $this->label = $sceneLabel;
        $this->targetScenes = $this->configureScene();
    }

    /**
     * @return AbstractScene[]
     */
    public function getTargetScenes(): array
    {
        return $this->targetScenes;
    }

    public function getSceneByTarget(string $target): AbstractScene
    {
        return SceneLibrary::get($this->targetScenes[$target]);
    }

}