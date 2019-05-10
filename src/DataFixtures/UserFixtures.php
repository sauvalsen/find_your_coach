<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new User();
        $user->setEmail('admin@mail.fr');
        $user->setRoles(array('ROLE_ADMIN','ROLE_USER'));
        $user->setPassword('password');
        $manager->persist($user);

        $user2 = new User();
        $user2->setEmail('user@mail.fr');
        $user2->setRoles(array('ROLE_USER'));
        $user2->setPassword('password');
        $user2->setNom('Roger');
        $user2->setPrenom('PetitPont');
        $user2->setAdresse('11 rue Pichon');
        $user2->setVille('Rouen');
        $user2->setTel('06 30 45 65 85');
        $user2->setDescription('Coucou, je suis Roger PetitPont');
        $user2->setAvatar('img');
        $user2->setSexe('Homme');
        $user2->setNiveau('Débutant');
        $manager->persist($user2);


        $user3 = new User();
        $user3->setEmail('coach@mail.fr');
        $user3->setRoles(array('ROLE_USER'));
        $user3->setPassword('password');
        $user3->setNom('Pierre');
        $user3->setPrenom('Martin');
        $user3->setAdresse('32 avenue Raton');
        $user3->setVille('Paris');
        $user3->setTel('06 58 65 32 14');
        $user3->setDiplome('BPJEPS');
        $user3->setDescription('Coucou, je suis Pierre Martin coach à domicile ! :)');
        $user3->setAvatar('img');
        $user3->setSexe('Homme');
        $manager->persist($user3);


        $manager->flush();
    }
}
