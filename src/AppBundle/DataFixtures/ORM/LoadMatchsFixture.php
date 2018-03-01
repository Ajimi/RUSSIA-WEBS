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
use Match\MatchBundle\Entity\Match;
use Reservation\TicketBundle\Entity\Ticket;
use Symfony\Component\ExpressionLanguage\Tests\Node\Obj;
use Team\TeamBundle\Entity\Team;

class LoadMatchsFixture implements FixtureInterface
{

    private $matches = array(
        ['date' => 'Thu Jun/14 2018', 'time' => '18:00', 'team1' => 'Russia', 'team2' => 'Saudi Arabia', 'staduim' => 'Luzhniki Stadium, Moscow'],
        ['date' => 'Fri Jun/15 2018', 'time' => '17:00', 'team1' => 'Egypt', 'team2' => 'Uruguay', 'staduim' => 'Central Stadium, Yekaterinburg'],
        ['date' => 'Tue Jun/19 2018', 'time' => '21:00', 'team1' => 'Russia', 'team2' => 'Egypt', 'staduim' => 'Krestovsky Stadium, Saint Petersburg'],
        ['date' => 'Wed Jun/20 2018', 'time' => '18:00', 'team1' => 'Uruguay', 'team2' => 'Saudi Arabia', 'staduim' => 'Rostov Arena, Rostov-on-Don'],
        ['date' => 'Mon Jun/25 2018', 'time' => '18:00', 'team1' => 'Uruguay', 'team2' => 'Russia', 'staduim' => 'Cosmos Arena, Samara'],
        ['date' => 'Mon Jun/25 2018', 'time' => '17:00', 'team1' => 'Saudi Arabia', 'team2' => 'Egypt', 'staduim' => 'Volgograd Arena, Volgograd'],
        ['date' => 'Fri Jun/15 2018', 'time' => '18:00', 'team1' => 'Morocco', 'team2' => 'Iran', 'staduim' => 'Krestovsky Stadium, Saint Petersburg'],
        ['date' => 'Fri Jun/15 2018', 'time' => '21:00', 'team1' => 'Portugal', 'team2' => 'Spain', 'staduim' => 'Fisht Olympic Stadium, Sochi'],
        ['date' => 'Wed Jun/20 2018', 'time' => '15:00', 'team1' => 'Portugal', 'team2' => 'Morocco', 'staduim' => 'Luzhniki Stadium, Moscow'],
        ['date' => 'Wed Jun/20 2018', 'time' => '21:00', 'team1' => 'Iran', 'team2' => 'Spain', 'staduim' => 'Kazan Arena, Kazan'],
        ['date' => 'Mon Jun/25 2018', 'time' => '21:00', 'team1' => 'Iran', 'team2' => 'Portugal', 'staduim' => 'Mordovia Arena, Saransk'],
        ['date' => 'Mon Jun/25 2018', 'time' => '20:00', 'team1' => 'Spain', 'team2' => 'Morocco', 'staduim' => 'Kaliningrad Stadium, Kaliningrad'],
        ['date' => 'Sat Jun/16 2018', 'time' => '13:00', 'team1' => 'France', 'team2' => 'Australia', 'staduim' => 'Kazan Arena, Kazan'],
        ['date' => 'Sat Jun/16 2018', 'time' => '19:00', 'team1' => 'Peru', 'team2' => 'Denmark', 'staduim' => 'Mordovia Arena, Saransk'],
        ['date' => 'Thu Jun/21 2018', 'time' => '16:00', 'team1' => 'Denmark', 'team2' => 'Australia', 'staduim' => 'Cosmos Arena, Samara'],
        ['date' => 'Thu Jun/21 2018', 'time' => '20:00', 'team1' => 'France', 'team2' => 'Peru', 'staduim' => 'Central Stadium, Yekaterinburg'],
        ['date' => 'Tue Jun/26 2018', 'time' => '17:00', 'team1' => 'Denmark', 'team2' => 'France', 'staduim' => 'Luzhniki Stadium, Moscow'],
        ['date' => 'Tue Jun/26 2018', 'time' => '17:00', 'team1' => 'Australia', 'team2' => 'Peru', 'staduim' => 'Fisht Olympic Stadium, Sochi'],
        ['date' => 'Sat Jun/16 2018', 'time' => '16:00', 'team1' => 'Argentina', 'team2' => 'Iceland', 'staduim' => 'Otkrytiye Arena, Moscow'],
        ['date' => 'Sat Jun/16 2018', 'time' => '21:00', 'team1' => 'Croatia', 'team2' => 'Nigeria', 'staduim' => 'Kaliningrad Stadium, Kaliningrad'],
        ['date' => 'Thu Jun/21 2018', 'time' => '21:00', 'team1' => 'Argentina', 'team2' => 'Croatia', 'staduim' => 'Nizhny Novgorod Stadium, Nizhny Novgorod'],
        ['date' => 'Fri Jun/22 2018', 'time' => '18:00', 'team1' => 'Nigeria', 'team2' => 'Iceland', 'staduim' => 'Volgograd Arena, Volgograd'],
        ['date' => 'Tue Jun/26 2018', 'time' => '21:00', 'team1' => 'Nigeria', 'team2' => 'Argentina', 'staduim' => 'Krestovsky Stadium, Saint Petersburg'],
        ['date' => 'Tue Jun/26 2018', 'time' => '21:00', 'team1' => 'Iceland', 'team2' => 'Croatia', 'staduim' => 'Rostov Arena, Rostov-on-Don'],
        ['date' => 'Sun Jun/17 2018', 'time' => '16:00', 'team1' => 'Costa Rica', 'team2' => 'Serbia', 'staduim' => 'Cosmos Arena, Samara'],
        ['date' => 'Sun Jun/17 2018', 'time' => '21:00', 'team1' => 'Brazil', 'team2' => 'Switzerland', 'staduim' => 'Rostov Arena, Rostov-on-Don'],
        ['date' => 'Fri Jun/22 2018', 'time' => '15:00', 'team1' => 'Brazil', 'team2' => 'Costa Rica', 'staduim' => 'Krestovsky Stadium, Saint Petersburg'],
        ['date' => 'Fri Jun/22 2018', 'time' => '20:00', 'team1' => 'Serbia', 'team2' => 'Switzerland', 'staduim' => 'Kaliningrad Stadium, Kaliningrad'],
        ['date' => 'Wed Jun/27 2018', 'time' => '21:00', 'team1' => 'Serbia', 'team2' => 'Brazil', 'staduim' => 'Otkrytiye Arena, Moscow'],
        ['date' => 'Wed Jun/27 2018', 'time' => '21:00', 'team1' => 'Switzerland', 'team2' => 'Costa Rica', 'staduim' => 'Nizhny Novgorod Stadium, Nizhny Novgorod'],
        ['date' => 'Sun Jun/17 2018', 'time' => '18:00', 'team1' => 'Germany', 'team2' => 'Mexico', 'staduim' => 'Luzhniki Stadium, Moscow'],
        ['date' => 'Mon Jun/18 2018', 'time' => '15:00', 'team1' => 'Sweden', 'team2' => 'South Korea', 'staduim' => 'Nizhny Novgorod Stadium, Nizhny Novgorod'],
        ['date' => 'Sat Jun/23 2018', 'time' => '18:00', 'team1' => 'South Korea', 'team2' => 'Mexico', 'staduim' => 'Rostov Arena, Rostov-on-Don'],
        ['date' => 'Sat Jun/23 2018', 'time' => '21:00', 'team1' => 'Germany', 'team2' => 'Sweden', 'staduim' => 'Fisht Olympic Stadium, Sochi'],
        ['date' => 'Wed Jun/27 2018', 'time' => '17:00', 'team1' => 'South Korea', 'team2' => 'Germany', 'staduim' => 'Kazan Arena, Kazan'],
        ['date' => 'Wed Jun/27 2018', 'time' => '19:00', 'team1' => 'Mexico', 'team2' => 'Sweden', 'staduim' => 'Central Stadium, Yekaterinburg'],
        ['date' => 'Mon Jun/18 2018', 'time' => '18:00', 'team1' => 'Belgium', 'team2' => 'Panama', 'staduim' => 'Fisht Olympic Stadium, Sochi'],
        ['date' => 'Mon Jun/18 2018', 'time' => '21:00', 'team1' => 'Tunisia', 'team2' => 'England', 'staduim' => 'Volgograd Arena, Volgograd'],
        ['date' => 'Sat Jun/23 2018', 'time' => '15:00', 'team1' => 'Belgium', 'team2' => 'Tunisia', 'staduim' => 'Otkrytiye Arena, Moscow'],
        ['date' => 'Sun Jun/24 2018', 'time' => '15:00', 'team1' => 'England', 'team2' => 'Panama', 'staduim' => 'Nizhny Novgorod Stadium, Nizhny Novgorod'],
        ['date' => 'Thu Jun/28 2018', 'time' => '20:00', 'team1' => 'England', 'team2' => 'Belgium', 'staduim' => 'Kaliningrad Stadium, Kaliningrad'],
        ['date' => 'Thu Jun/28 2018', 'time' => '21:00', 'team1' => 'Panama', 'team2' => 'Tunisia', 'staduim' => 'Mordovia Arena, Saransk'],
        ['date' => 'Tue Jun/19 2018', 'time' => '15:00', 'team1' => 'Colombia', 'team2' => 'Japan', 'staduim' => 'Mordovia Arena, Saransk'],
        ['date' => 'Tue Jun/19 2018', 'time' => '18:00', 'team1' => 'Poland', 'team2' => 'Senegal', 'staduim' => 'Otkrytiye Arena, Moscow'],
        ['date' => 'Sun Jun/24 2018', 'time' => '20:00', 'team1' => 'Japan', 'team2' => 'Senegal', 'staduim' => 'Central Stadium, Yekaterinburg'],
        ['date' => 'Sun Jun/24 2018', 'time' => '21:00', 'team1' => 'Poland', 'team2' => 'Colombia', 'staduim' => 'Kazan Arena, Kazan'],
        ['date' => 'Thu Jun/28 2018', 'time' => '17:00', 'team1' => 'Japan', 'team2' => 'Poland', 'staduim' => 'Volgograd Arena, Volgograd'],
        ['date' => 'Thu Jun/28 2018', 'time' => '18:00', 'team1' => 'Senegal', 'team2' => 'Colombia', 'staduim' => 'Cosmos Arena, Samara']);


    /*
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $length = count($this->matches);
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < $length; $i++) {
            $schedule = $this->matches[$i];
            $match = $this->createMatch($schedule, $manager, $faker);
            $ticket = new Ticket();
            $ticket->setPrice(160);
            $ticket->setQuantity(500);
            $match->setTicket($ticket);
            $ticket->setMatch($match);
            $manager->persist($match);
            $manager->persist($ticket);
            $manager->flush();
        }
    }

    public function createMatch($schedule, ObjectManager $manager, $faker)
    {
        $team1 = $this->getTeam($schedule['team1'], $manager);
        $team2 = $this->getTeam($schedule['team2'], $manager);
        $match = new Match();
        $match->setTeam1($team1);
        $match->setTeam2($team2);
        $match->setDate($this->formatTime($schedule['date']));

        $match->setTime($schedule['time']);
        $match->setStadium($schedule['staduim']);
        $match->setLevel('Round of 32');
        $match->setPlayed(false);


        return $match;

    }

    /**
     * @param $name
     * @param ObjectManager $manager
     * @return null|object|Team
     */
    public function getTeam($name, ObjectManager $manager)
    {
        $teamRepo = $manager->getRepository('TeamBundle:Team');
        $team = $teamRepo->findOneBy(['teamName' => $name]);

        return $team;

    }

    /**
     * @param $date
     * @return bool|\DateTime
     */
    public function formatTime($date)
    {
        return \DateTime::createFromFormat('D M/j Y', $date);
    }


}