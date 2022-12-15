<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {

            $user = new User();

            $user->setFirstName('firstname_'.$i)
                ->setLastName('lastName'.$i)
                ->setEmail('test@email'.$i.'.com')
                ->setBirthDate(new \DateTime())
            ;

            $manager->persist($user);
        }

        $manager->flush();
    }
}