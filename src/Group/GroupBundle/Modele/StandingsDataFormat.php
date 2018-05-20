<?php
/**
 * Created by PhpStorm.
 * User: BOOK
 * Date: 26/02/2018
 * Time: 20:51
 */

namespace Group\GroupBundle\Modele;


use Group\GroupBundle\Entity\Groupe;

class StandingsDataFormat
{

    public static function oneGroupStandingFormat(Groupe $g)
    {

        $standings = [];

        $s1 = new StandingsFormat();
        $s2 = new StandingsFormat();
        $s3 = new StandingsFormat();
        $s4 = new StandingsFormat();

        $s1->setGroup($g->getNameGroup());
        $s2->setGroup($g->getNameGroup());
        $s3->setGroup($g->getNameGroup());
        $s4->setGroup($g->getNameGroup());

        $s1->dataFormat($g->getTeam1());
        array_push($standings, $s1);
        $s2->dataFormat($g->getTeam2());
        array_push($standings, $s2);
        $s3->dataFormat($g->getTeam3());
        array_push($standings, $s3);
        $s4->dataFormat($g->getTeam4());
        array_push($standings, $s4);

        usort($standings, function ($a, $b) {
            return $a->points < $b->points;
        });

        return $standings;
    }

    public static function fullStandings($groups)
    {
        $fullStandings = [];
        /** @var Groupe $g */
        foreach ( $groups as $g)
        {

            $standings = [];

            $s1 = new StandingsFormat();
            $s2 = new StandingsFormat();
            $s3 = new StandingsFormat();
            $s4 = new StandingsFormat();

            $s1->setGroup($g->getNameGroup());
            $s2->setGroup($g->getNameGroup());
            $s3->setGroup($g->getNameGroup());
            $s4->setGroup($g->getNameGroup());

            $s1->dataFormat($g->getTeam1());
            dump($g->getTeam1());
            array_push($standings, $s1);
            $s2->dataFormat($g->getTeam2());
            array_push($standings, $s2);
            $s3->dataFormat($g->getTeam3());
            array_push($standings, $s3);
            $s4->dataFormat($g->getTeam4());
            array_push($standings, $s4);

            usort($standings, function ($a, $b) {
                return $a->points < $b->points;
            });

            array_push($fullStandings,$standings);
        }

        return $fullStandings;
    }


}