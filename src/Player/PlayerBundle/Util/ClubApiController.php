<?php
/**
 * Created by PhpStorm.
 * User: KaYdaz
 * Date: 30/04/2018
 * Time: 11:22
 */

namespace Player\PlayerBundle\Util;


use Player\PlayerBundle\Entity\Club;

class ClubApiController
{

    /**
     * @param array|Club[] $clubs
     * @return array
     * @internal param $
     */
    public static function serializer($clubs)
    {
        $data = array();
        foreach ($clubs as $club) {
            $clubData = ClubApiController::serialize($club);
            $data[] = $clubData;
        }
        return $data;
    }

    /**
     * @param Club $club
     * @return array
     * @internal param $clubs
     */
    public static function serialize(Club $club)
    {
        return array(
            "id" => $club->getId(),
            "clubName" => $club->getClubName(),
            "seasonStart" => $club->getSeasonStart(),
            "matchPlayed" => $club->getMatchPlayed(),
            "goalScored" => $club->getGoalScored()
        );
    }
}