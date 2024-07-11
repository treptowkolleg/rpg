<?php

namespace Btinet\Rpg\Character\Utility;

trait LabelTrait
{

    private string $label;

    public function __toString(): string
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

}
