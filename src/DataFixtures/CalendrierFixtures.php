<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Calendrier;

class CalendrierFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $calendrier = new User();
        $calendrier->setStart_date('2019-05-10 09:50:00');
        $calendrier->setEnd_date('2019-05-10 10:50:00');
        $calendrier->setTitre('Séance');
        $manager->persist($calendrier);

        $manager->flush();
    }
}
