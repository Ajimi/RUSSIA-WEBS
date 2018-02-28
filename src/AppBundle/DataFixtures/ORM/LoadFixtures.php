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
use Nelmio\Alice\Fixtures;

class LoadFixtures implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $objects = Fixtures::load(
            [
//                __DIR__ . '/fixtures.yml',
//                __DIR__ . '/user.yml',
//                __DIR__ . '/tickets.yml',
//                //__DIR__ . '/team.yml',
            ],
            $manager,
            [
                'providers' => [$this]
            ]
        );
    }

    public function roomType()
    {
        $genera = [
            'Octopus',
            'Balaena',
            'Orcinus',
            'Hippocampus',
            'Asterias',
        ];

        $key = array_rand($genera);

        return $genera[$key];
    }
}