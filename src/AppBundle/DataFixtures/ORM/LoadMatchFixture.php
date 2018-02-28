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
use Team\TeamBundle\Entity\Team;

class LoadMatchFixture implements FixtureInterface
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

            $groupName = $this->getGroup($pas);
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

            $manager->persist($team);
            $manager->persist($group);
            $manager->flush();
        }
    }

    public function getTeam($number = 0)
    {
        $teams = ["Russia", "Saudi Arabia", "Egypt", "Uruguay", "Portugal", "Spain", "Morocco", "Iran", "France ", "Australia "
            , "Peru", "Denmark", "Argentina", "Iceland", "Croatia", "Nigeria", "Brazil", "Switzerland", "Costa Rica", "Serbia", "Germany",
            "Mexico", "Sweden", "South Korea", "Belgium", "Panama", "Tunisia", "England", "Poland", "Senegal", "Colombia", "Japan"];
        return $teams[$number];
    }

    public function getTeamShortcut($number = 0)
    {
        $teams = ["Russia", "Saudi Arabia", "Egypt", "Uruguay", "Portugal", "Spain", "Morocco", "Iran", "France ", "Australia "
            , "Peru", "Denmark", "Argentina", "Iceland", "Croatia", "Nigeria", "Brazil", "Switzerland", "Costa Rica", "Serbia", "Germany",
            "Mexico", "Sweden", "South Korea", "Belgium", "Panama", "Tunisia", "England", "Poland", "Senegal", "Colombia", "Japan"];
        return $teams[$number];
    }

    public function getGroup($number = 0)
    {
        $groups = ["A", "B", "C", "D", "E", "F", "G", "H"];
        return $groups[$number];
    }

    /**
     * @param $teamName
     * @param $teamShortcut
     * @param Generator $faker
     * @return Team
     */
    public function generateTeam($teamName, $teamShortcut, $faker)
    {
        /** @var Team $team */
        $team = new Team();
        $team->setTeamName($teamName);
        $team->setTeamLogo(strtolower($teamName . '.jpg'));
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


}