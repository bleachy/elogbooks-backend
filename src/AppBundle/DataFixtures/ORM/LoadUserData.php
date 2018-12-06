<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

/**
 * Class LoadUserData
 * @package AppBundle\DataFixtures\ORM
 */
class LoadUserData implements FixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $users = [
            [
                'name' => 'Elon Musk',
                'email' => 'emusk@gmail.com',
            ],
            [
                'name' => 'Steve Jobs',
                'email' => 'sjobs@gmail.com',
            ],
            [
                'name' => 'Bill Gates',
                'email' => 'bgates@gmail.com',
            ],
            [
                'name' => 'Stephen Hawking',
                'email' => 'shawking@gmail.com',
            ],
        ];

        foreach ($users as $userData) {
            $user = new User();
            $user
                ->setName($userData['name'])
                ->setEmail($userData['email']);

            $manager->persist($user);
        }

        $manager->flush();
    }
}