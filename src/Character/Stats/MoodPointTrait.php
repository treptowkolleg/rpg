<?php

namespace Btinet\Rpg\Character\Stats;

/**
 * beeinflusst Trefferquote, Angriffspunkte und Verteidigungspunkte
 * x > 0 → gesteigerte Aggression: AP+, DP-, TQ-
 * x < 0 → verminderte Aggression: AP-, DP+, TQ+
 */
trait MoodPointTrait
{

    private float $moodPoints;

    /**
     * @return float
     */
    public function getMoodPoints(): float
    {
        return $this->moodPoints;
    }

    /**
     * @param float $moodPoints
     */
    public function setMoodPoints(float $moodPoints): void
    {
        $this->moodPoints = $moodPoints;
    }

}
