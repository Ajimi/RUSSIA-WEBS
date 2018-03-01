<?php
/**
 * Created by PhpStorm.
 * User: hir0w
 * Date: 2/10/2018
 * Time: 8:34 PM
 */

namespace AppBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Generator;
use Group\GroupBundle\Entity\Groupe;
use Player\PlayerBundle\Entity\Club;
use Player\PlayerBundle\Entity\Player;
use Player\PlayerBundle\Entity\Skill;
use Team\TeamBundle\Entity\Team;

class LoadTeamsFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();

        $k = 0;
        $pas = 0;
        for ($i = 0; $i < 32; $i++) {
            $teamName = $this->getTeam($i);
            $teamShortcut = $this->getTeamShortcut($i);
            if ($k == 4) {
                $k = 0;
                $pas++;
            }
            $k++;

            if ($pas < 8)
                $groupName = $this->getGroup($pas);
            else
                break;
            /** @var Groupe $group */
            $group = $manager->getRepository('GroupBundle:Groupe')
                ->findOneBy(['name' => $groupName]);
            if (is_null($group)) {
                $group = new Groupe();
                $group->setName($groupName);
                $group->setRating($faker->numberBetween(0, 5));
            }


            /** @var Team $team */
            $team = $this->generateTeam($teamName, $teamShortcut, $faker);


            switch ($k) {
                case 1:
                    $group->setTeam1($team);
                    break;
                case 2:
                    $group->setTeam2($team);
                    break;
                case 3:
                    $group->setTeam3($team);
                    break;
                case 4:
                    $group->setTeam4($team);
                    break;
            }

            for ($i = 0; $i < 3; $i++) {
                $player = $this->generatePlayer($faker);
                for ($j = 0; $j < 2; $j++) {
                    $club = $this->generateClub($faker);
                    $skill = $this->generateSkill($faker);
                    $skill->setPlayer($player);
                    $club->setPlayer($player);
                    $manager->persist($club);
                    $manager->persist($skill);
                }
                $player->setNationalTeam($team);
                $manager->persist($player);
            }

            $manager->persist($team);
            $manager->persist($group);
            $manager->flush();
        }
    }

    public function getTeam($number = 0)
    {
        $teams = ["Russia", "Saudi Arabia", "Egypt", "Uruguay", "Portugal", "Spain", "Morocco", "Iran", "France", "Australia "
            , "Peru", "Denmark", "Argentina", "Iceland", "Croatia", "Nigeria", "Brazil", "Switzerland", "Costa Rica", "Serbia", "Germany",
            "Mexico", "Sweden", "South Korea", "Belgium", "Panama", "Tunisia", "England", "Poland", "Senegal", "Colombia", "Japan"];
        return $teams[$number];
    }

    public function getTeamShortcut($number = 0)
    {
        $teams = ["RUS", "SAU", "EGY", "URU", "POR", "SPA", "MRC", "IRN", "FRA", "AUS "
            , "PER", "DEN", "ARG", "ICE", "CRO", "NGR", "BRA", "SWZ", "CSR", "SER", "GER",
            "MEX", "SWE", "SKR", "BEL", "PAN", "TUN", "END", "POL", "SEN", "COL", "JAP"];
        return $teams[$number];
    }

    public function getGroup($number = 0)
    {
        $groups = ["A", "B", "C", "D", "E", "F", "G", "H"];

        echo $number;
        return $groups[$number];
    }

    /**
     * @param string $teamName
     * @param $teamShortcut
     * @param Generator $faker
     * @return Team
     */
    public function generateTeam($teamName, $teamShortcut, $faker)
    {
        /** @var Team $team */
        $team = new Team();
        $team->setTeamName($teamName);
        $array = explode(' ', $teamName);
        $team->setTeamLogo(strtolower($array[0] . '.png'));
        $team->setTeamShortcut($teamShortcut);
        $team->setMatchWon($faker->randomDigitNotNull);
        $team->setMatchLost($faker->randomDigitNotNull);
        $team->setGoalScored($faker->randomDigitNotNull);
        $team->setGoalIn($faker->randomDigitNotNull);
        $team->setMatchDraw($faker->randomDigitNotNull);
        $team->setParticipation($faker->randomDigitNotNull);
        $team->setWinner($faker->randomDigitNotNull);
        $team->setSecond($faker->randomDigitNotNull);
        $team->setThird($faker->randomDigitNotNull);

        return $team;
    }

    public function generatePlayer(Generator $faker)
    {
        $player = new Player();
        $player->setPlayerName($faker->firstName);
        $player->setPlayerLastName($faker->lastName);
        $player->setFile("player-3-368x286.png");
        $player->setPlayerImage("player-3-368x286.png");
        $player->setPlayerPosition($faker->word);
        $player->setPlayerNumber($faker->numberBetween(1, 20));
        $player->setBio($faker->word);
        $player->setWeight($faker->numberBetween(0, 11));
        $player->setHeight($faker->numberBetween(0, 11));
        $player->setTotalGames($faker->numberBetween(0, 11));
        $player->setGoalScored($faker->numberBetween(0, 11));
        $player->setShots($faker->numberBetween(33, 99));
        $player->setShotsOnTarget($faker->numberBetween(11, 33));
        $player->setAssists($faker->numberBetween(0, 11));
        $player->setFouls($faker->numberBetween(0, 11));
        $player->setPasses($faker->numberBetween(0, 11));
        $player->setYellowCard($faker->numberBetween(0, 11));
        $player->setPenaltyKicks($faker->numberBetween(0, 11));
        $player->setCornerKicks($faker->numberBetween(0, 11));
        $player->setRedCard($faker->numberBetween(0, 11));
        $player->setBirthday($faker->dateTimeThisDecade());
        $player->setTeam($faker->word);
        $player->setVisits($faker->numberBetween(0, 15));
        $player->setGoalScored($faker->numberBetween(0, 15));


        return $player;
    }

    private function generateSkill(Generator $faker)
    {
        $skill = new Skill();
        $skill->setLabel($faker->word);
        $skill->setValue($faker->numberBetween(0, 99));

        return $skill;
    }

    private function generateClub(Generator $faker)
    {
        $club = new Club();
        $club->setClubName($faker->word);
        $club->setSeasonStart($faker->numberBetween(2008, 2015));
        $club->setMatchPlayed($faker->numberBetween(0, 99));
        $club->setGoalScored($faker->numberBetween(0, 99));

        return $club;
    }


}

