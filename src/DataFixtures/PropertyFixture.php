<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class PropertyFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i = 0; $i < 100; $i++) {
            $property = new Property();
            $property
                ->setTitle($faker->words(3, true))
                ->setDescription($faker->sentences(3, true))
                ->setSurface($faker->numberBetween(18, 468))
                ->setRooms($faker->numberBetween(1,12))
                ->setBedrooms($faker->numberBetween(1,7))
                ->setFloor($faker->numberBetween(0,15))
                ->setPrice($faker->numberBetween(125000,3856000))
                ->setHeat($faker->numberBetween(0,count(Property::HEAT)-1))
                ->setCity($faker->City)
                ->setAddress($faker->streetAddress)
                ->setPostalCode($faker->randomNumber(5, true))
                ->setSold(false)
                ;

                $manager->persist($property);
        }

        $manager->flush();
    }
}
