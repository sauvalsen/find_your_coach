<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setEmail('user1@mail.fr');
        $user1->setRoles(array('ROLE_USER'));
        $user1->setPassword('password');
        $user1->setNom('Pierre');
        $user1->setPrenom('Pierrot');
        $user1->setAdresse('11 rue Du General');
        $user1->setCodePostal('76000');
        $user1->setVille('Rouen');
        $user1->setTel('06-30-45-65-85');
        $user1->setDescription('Coucou, je suis Pierre Pierrot');
        $user1->setAvatar('img');
        $user1->setSexe('Homme');
        $user1->setNiveau('Confirmé');
        $manager->persist($user1);


        $user2 = new User();
        $user2->setEmail('user2@mail.fr');
        $user2->setRoles(array('ROLE_USER'));
        $user2->setPassword('password');
        $user2->setNom('PetitPont');
        $user2->setPrenom('Roger');
        $user2->setAdresse('11 rue Pichon');
        $user2->setCodePostal('7600');
        $user2->setVille('Rouen');
        $user2->setTel('06 30 45 65 85');
        $user2->setDescription('Coucou, je suis Roger PetitPont');
        $user2->setAvatar('img');
        $user2->setSexe('Homme');
        $user2->setNiveau('Débutant');
        $manager->persist($user2);


        $user3 = new User();
        $user3->setEmail('user3@mail.fr');
        $user3->setRoles(array('ROLE_USER'));
        $user3->setPassword('password');
        $user3->setNom('Clement');
        $user3->setPrenom('Maxime');
        $user3->setAdresse('32 avenue Raton');
        $user3->setCodePostal('75000');
        $user3->setVille('Paris');
        $user3->setTel('06.58.65.32.14');
        $user3->setDescription('Coucou, je suis Martin ! :)');
        $user3->setAvatar('img');
        $user3->setSexe('Homme');
        $user3->setNiveau('Intermediaire');
        $manager->persist($user3);

        $user4 = new User();
        $user4->setEmail('user4@mail.fr');
        $user4->setRoles(array('ROLE_USER'));
        $user4->setPassword('password');
        $user4->setNom('Lefevre');
        $user4->setPrenom('Anne');
        $user4->setAdresse('32 avenue Raton');
        $user4->setCodePostal('75000');
        $user4->setVille('Paris');
        $user4->setTel('06 58 65 32 14');
        $user4->setDescription('Coucou, je suis Anne Lefevre ! :)');
        $user4->setAvatar('img');
        $user4->setSexe('Femme');
        $user4->setNiveau('Confirmé');
        $manager->persist($user4);

        $user5 = new User();
        $user5->setEmail('user5@mail.fr');
        $user5->setRoles(array('ROLE_USER'));
        $user5->setPassword('password');
        $user5->setNom('Frite');
        $user5->setPrenom('Stephane');
        $user5->setAdresse('32 avenue de la Frite');
        $user5->setCodePostal('76220');
        $user5->setVille('Dunkerque');
        $user5->setTel('06 58 65 32 14');
        $user5->setDescription('Coucou, je suis Frite Stephane ! :)');
        $user5->setAvatar('img');
        $user5->setSexe('Femme');
        $user5->setNiveau('Confirmé');
        $manager->persist($user5);


        $manager->flush();
    }
}
