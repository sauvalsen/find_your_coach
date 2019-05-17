<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Calendrier;
use App\Entity\User;
use App\DataFixtures\UserFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
class CalendrierFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
     
        $calendrier = new Calendrier();
        $calendrier->setStartDate(new \DateTime('01-01-2014 00:00:00'));
        $calendrier->setEndDate(new \DateTime('01-01-2014 00:00:00'));
        $calendrier->setSportif($this->getReference('user1'));
        $calendrier->setCoach($this->getReference('coach'));
        $calendrier->setTitre('Cours de pilate');
        $manager->persist($calendrier);

        $calendrier2 = new Calendrier();
        $calendrier2->setStartDate(new \DateTime('08-01-2014 07:00:00'));
        $calendrier2->setEndDate(new \DateTime('08-01-2014 08:00:00'));
        $calendrier2->setSportif($this->getReference('user2'));
        $calendrier2->setCoach($this->getReference('coach2'));
        
        $calendrier2->setTitre('Cours de yoga');
        $manager->persist($calendrier2);


        $calendrier3 = new Calendrier();
        $calendrier3->setStartDate(new \DateTime('01-01-2014 00:00:00'));
        $calendrier3->setEndDate(new \DateTime('01-01-2014 00:00:00'));
        $calendrier3->setSportif($this->getReference('user3'));
        $calendrier3->setCoach($this->getReference('coach5'));
        $calendrier3->setTitre('Cours de renforcement');
        $manager->persist($calendrier3);


        $calendrier4 = new Calendrier();
        $calendrier4->setStartDate(new \DateTime('01-01-2014 00:00:00'));
        $calendrier4->setEndDate(new \DateTime('01-01-2014 00:00:00'));
        $calendrier4->setSportif($this->getReference('user4'));
        $calendrier4->setCoach($this->getReference('coach3'));
        $calendrier4->setTitre('Cours de Karaté');
        $manager->persist($calendrier4);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }

}
