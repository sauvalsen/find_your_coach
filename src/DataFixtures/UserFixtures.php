<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        ////////////////////////////////////////COACH////////////////////////////////////////////

        $coach= new User();
        $coach->setEmail('coach@mail.fr');
        $coach->setRoles(array('ROLE_ADMIN','ROLE_USER'));
        $coach->setPassword('password');
        $coach->setNom('Legrand');
        $coach->setPrenom('Pierre');
        $coach->setAdresse('32 avenue du havre');
        $coach->setVille('Paris');
        $coach->setTel('06 58 98 32 14');
        $coach->setDiplome('BPJEPS');
        $coach->setDescription('Coucou, je suis pierre legrand coach à domicile ! :)');
        $coach->setAvatar('img');
        $coach->setSexe('Homme');
        $manager->persist($coach);

       
    

        $coach2= new User();
        $coach2->setEmail('coach2@mail.fr');
        $coach2->setRoles(array('ROLE_ADMIN','ROLE_USER'));
        $coach2->setPassword('password');
        $coach2->setNom('Gras');
        $coach2->setPrenom('Louis');
        $coach2->setAdresse('32 avenue souris');
        $coach2->setVille('Dieppe');
        $coach2->setTel('06 58 98 32 14');
        $coach2->setDiplome('BPJEPS');
        $coach2->setDescription('Coucou, je suis Louis Gras coach à domicile ! :)');
        $coach2->setAvatar('img');
        $coach2->setSexe('Homme');
        $manager->persist($coach2);


        $coach3= new User();
        $coach3->setEmail('coach3@mail.fr');
        $coach3->setRoles(array('ROLE_ADMIN','ROLE_USER'));
        $coach3->setPassword('password');
        $coach3->setNom('Martin');
        $coach3->setPrenom('Claire');
        $coach3->setAdresse('32 rue des marins');
        $coach3->setVille('lille');
        $coach3->setTel('06 89 98 90 12');
        $coach3->setDiplome('BPJEPS');
        $coach3->setDescription('Coucou, je suis Claire Martin coach à domicile ! :)');
        $coach3->setAvatar('img');
        $coach3->setSexe('femme');
        $manager->persist($coach3);


        $coach4= new User();
        $coach4->setEmail('coach4@mail.fr');
        $coach4->setRoles(array('ROLE_ADMIN','ROLE_USER'));
        $coach4->setPassword('password');
        $coach4->setNom('Quidel');
        $coach4->setPrenom('Antoine');
        $coach4->setAdresse('32 rue des iris');
        $coach4->setVille('Arques la Bataille');
        $coach4->setTel('07 89 98 00 56');
        $coach4->setDiplome('BPJEPS');
        $coach4->setDescription('Coucou, je suis Antoine Quidel coach à domicile ! :)');
        $coach4->setAvatar('img');
        $coach4->setSexe('homme');
        $manager->persist($coach4);


        $coach5= new User();
        $coach5->setEmail('coach5@mail.fr');
        $coach5->setRoles(array('ROLE_ADMIN','ROLE_USER'));
        $coach5->setPassword('password');
        $coach5->setNom('Grandjacques');
        $coach5->setPrenom('Elise');
        $coach5->setAdresse('322 route des moulins');
        $coach5->setVille('Rennes');
        $coach5->setTel('06 76 43 90 17');
        $coach5->setDiplome('BPJEPS');
        $coach5->setDescription('Coucou, je suis Elise Grandjacques coach à domicile ! :)');
        $coach5->setAvatar('img');
        $coach5->setSexe('femme');
        $manager->persist($coach5);

        $manager->flush();
    }

}
