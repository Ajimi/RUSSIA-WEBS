<?php
/**
 * Created by PhpStorm.
 * User: KaYdaz
 * Date: 28/02/2018
 * Time: 22:31
 */

namespace Player\PlayerBundle\Util;


class UtilPlayer
{
    function playerSkills($player, &$shotAcc, &$finishing)
    {
        if ($player->shotsOnTarget != 0)
            $finishing = $player->goalScored * 100 / $player->shotsOnTarget;
        else
            $finishing = 0;
        if ($player->shots != 0)
            $shotAcc = $player->shotsOnTarget * 100 / $player->shots;
        else
            $shotAcc = 0;
    }
}