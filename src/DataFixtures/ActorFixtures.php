<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       $actor = new Actor();
       $actor->setName('Dwayne Johnson');
       $manager->persist($actor);

       $actor2 = new Actor();
       $actor2->setName('Will Smith');
       $manager->persist($actor2);

       $actor3 = new Actor();
       $actor3->setName('Tom Cruise');
       $manager->persist($actor3);

       $actor4 = new Actor();
       $actor4->setName('Test Actor');
       $manager->persist($actor4);

       $manager->flush();

       $this->addReference('actor_1', $actor);
       $this->addReference('actor_2', $actor2);
       $this->addReference('actor_3', $actor3);
       $this->addReference('actor_4', $actor4);


    }
}