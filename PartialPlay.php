<?php
namespace Moserware\Skills;

require_once(dirname(__FILE__) . "/ISupportPartialPlay.php");

class PartialPlay
{
    public static function getPartialPlayPercentage($player)
    {
        // If the player doesn't support the interface, assume 1.0 == 100%
        $supportsPartialPlay = $player instanceof ISupportPartialPlay;
        if (!$supportsPartialPlay)
        {
            return 1.0;
        }

        $partialPlayPercentage = $partialPlay->getPartialPlayPercentage();

        // HACK to get around bug near 0
        $smallestPercentage = 0.0001;
        if ($partialPlayPercentage < $smallestPercentage)
        {
            $partialPlayPercentage = $smallestPercentage;
        }

        return $partialPlayPercentage;
    }
}

?>
