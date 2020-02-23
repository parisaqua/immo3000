<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class UserFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i = 0; $i < 5; $i++) {
            $user = new User();
            $user
                ->setGender($faker->numberBetween(0, 1))
                ->setEmail($faker->email)
                ->setFirstName($faker->firstName)
                ->setLastName($faker->lastName)
                ->setActive(true)
                ->setPassword($faker->password)
                ;

                $manager->persist($user);
        }

        $manager->flush();
    }
}
