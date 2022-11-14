<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Movie;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $movie = new Movie();
        $movie->setTitle('Test Movie');
        $movie->setReleaseYear(2005);
        $movie->setDescription('Test Movie Description');
        $movie->setImagePath('https://cdn.pixabay.com/photo/2020/01/26/18/52/porsche-4795517_1280.jpg');

        //Add Data to Pivot Table 
        //this is coming from ActorFixtures where we set the Reference
        $movie->addActor($this->getReference('actor_1'));
        $movie->addActor($this->getReference('actor_2'));

        //insert in DB using ObjectManager
        $manager->persist($movie);

        $movie2 = new Movie();
        $movie2->setTitle('Test Movie Two');
        $movie2->setReleaseYear(2007);
        $movie2->setDescription('Test Movie Two Description');
        $movie2->setImagePath('https://cdn.pixabay.com/photo/2021/09/06/19/03/luxury-car-6602359_1280.jpg');

        $movie2->addActor($this->getReference('actor_3'));
        $movie2->addActor($this->getReference('actor_4'));

        //insert in DB using ObjectManager
        $manager->persist($movie2);

        //this allows both queries to be executed at the same time
        $manager->flush();

    }
}
