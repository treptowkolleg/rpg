<?php

namespace Btinet\Rpg\Engine;

use Exception;

class ActionEngine
{

    /**
     * @param float $factor Input-Factor
     * @param int $lowerEnd Lower End
     * @param int $tippingPoint Tipping Point for Critical Attack
     * @param int $upperEnd Upper End
     * @return float Resulting Factor
     * @throws Exception
     */
    public static function differ(float $factor, int $lowerEnd = 70, int $tippingPoint = 110, int $upperEnd = 130): float
    {
        if($tippingPoint > $upperEnd or $tippingPoint <= $lowerEnd) {
            throw new Exception(sprintf("Tipping-Point %s muss zwischen %s und %s liegen!",$tippingPoint,$lowerEnd,$upperEnd));
        }

        $rndInteger = rand($lowerEnd,$upperEnd);
        if($rndInteger > $tippingPoint) {
            if(rand(0,100) < 50) {
                $rndInteger = $tippingPoint;
            }
        }
        return $factor * $rndInteger / 100;
    }


    public static function criticalHit(int &$ap): void
    {
        if(rand(0,100) >= 97) {
            echo "\e[91mKritischer Treffer!\n";
            $ap = $ap * 2;
        }
    }

}