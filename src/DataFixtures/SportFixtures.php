<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Sport;
use App\Entity\Search;
use App\DataFixtures\UserFixtures;
class SportFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $sport = new Sport();
        $sport->setSport('Foot');
        $sport->addUser($this->getReference("coach3"));
        $sport->addUser($this->getReference("coach"));
        $sport->addUser($this->getReference("coach2"));
        $manager->persist($sport);

        $sport2 = new Sport();
        $sport2->setSport('Baseball');
        $sport2->addUser($this->getReference("coach8"));
        $sport2->addUser($this->getReference("coach5"));
        $sport2->addUser($this->getReference("coach"));
        $manager->persist($sport2);

        $sport3 = new Sport();
        $sport3->setSport('Judo');
        $sport3->addUser($this->getReference("coach8"));
        $sport3->addUser($this->getReference("coach4"));
        $sport3->addUser($this->getReference("coach2"));
        $sport3->addUser($this->getReference("coach9"));
        $manager->persist($sport3);

        $sport4 = new Sport();
        $sport4->setSport('Basket');
        $sport4->addUser($this->getReference("coach7"));
        $sport4->addUser($this->getReference("coach6"));
        $sport4->addUser($this->getReference("coach5"));
        $manager->persist($sport4);

        $sport5 = new Sport();
        $sport5->setSport('Yoga');
        $sport5->addUser($this->getReference("coach8"));
        $sport5->addUser($this->getReference("coach4"));
        $sport5->addUser($this->getReference("coach2"));
        $manager->persist($sport5);

        $sport6 = new Sport();
        $sport6->setSport('Tennis');
        $sport6->addUser($this->getReference("coach"));
        $manager->persist($sport6);

        $sport7 = new Sport();
        $sport7->setSport('Karaté');
        $manager->persist($sport7);

        $sport8 = new Sport();
        $sport8->setSport('Kayak');
        $sport8->addUser($this->getReference("coach8"));
        $sport8->addUser($this->getReference("coach"));
        $sport8->addUser($this->getReference("coach2"));

        $manager->persist($sport8);
        $manager->flush();
    }
    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
