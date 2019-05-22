<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Sport;

class SportFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $sport = new Sport();
        $sport->setSport('Foot');
        $manager->persist($sport);

        $sport2 = new Sport();
        $sport2->setSport('Baseball');
        $manager->persist($sport2);

        $sport3 = new Sport();
        $sport3->setSport('Judo');
        $manager->persist($sport3);

        $sport4 = new Sport();
        $sport4->setSport('Basket');
        $manager->persist($sport4);

        $sport5 = new Sport();
        $sport5->setSport('Yoga');
        $manager->persist($sport5);

        $sport6 = new Sport();
        $sport6->setSport('Tennis');
        $manager->persist($sport6);

        $sport7 = new Sport();
        $sport7->setSport('Karaté');
        $manager->persist($sport7);

        $sport8 = new Sport();
        $sport8->setSport('Karaté2');
        $manager->persist($sport8);

    
        $manager->flush();
    }
}
