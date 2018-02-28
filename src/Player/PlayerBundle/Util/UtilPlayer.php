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
        if ($player->getShotsOnTarget() != 0)
            $finishing = $player->getGoalScored() * 100 / $player->getShotsOnTarget();
        else
            $finishing = 0;
        if ($player->getShots() != 0)
            $shotAcc = $player->getShotsOnTarget() * 100 / $player->getShots();
        else
            $shotAcc = 0;
    }
}