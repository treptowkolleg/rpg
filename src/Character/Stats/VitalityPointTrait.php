<?php

namespace Btinet\Rpg\Character\Stats;

/**
 * beeinflusst Geschwindigkeit
 * je größer VP, desto höher die Geschwindigkeit: Ausweichen+, ActionPerRound+.
 * je kleiner VP, desto geringer Geschwindigkeit: Ausweichen-, ActionPerRound-.
 *
 * Leichte Waffen und Rüstungen erlauben höhere Geschwindigkeiten.
 */
trait VitalityPointTrait
{

    private float $vp;

    /**
     * @return float
     */
    public function getVp(): float
    {
        return $this->vp;
    }

    /**
     * @param float $vp
     */
    public function setVp(float $vp): void
    {
        $this->vp = $vp;
    }

}
