<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{


    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $dev = new User();
        $dev->setEmail('dev@mail.fr');
        $dev->setRoles(array('ROLE_SUPER_ADMIN'));
        $dev->setIsActive(true);
        $dev->setPassword($this->passwordEncoder->encodePassword($dev, 'dev'));
        $dev->setPrenom('Alban');
        $manager->persist($dev);

        $userweb = new User();
        $userweb->setEmail('quidelantoine@mail.com');
        $userweb->setNom('antoine');
        $userweb->setPrenom('quidel');
        $userweb->setRoles(array('ROLE_ADMIN'));
        $userweb->setIsActive(true);
        $userweb->setPassword($this->passwordEncoder->encodePassword($userweb, 'password'));
        $manager->persist($userweb);

        $user1 = new User();
        $user1->setEmail('pierredelarue@mail.fr');
        $user1->setRoles(array('ROLE_USER'));
        $user1->setIsActive(true);
        $user1->setPassword($this->passwordEncoder->encodePassword($user1, 'password'));
        $user1->setNom('Delarue');
        $user1->setPrenom('Pierre');
        $user1->setAdresse('11 rue Du General');
        $user1->setCodePostal('76000');
        $user1->setVille('Rouen');
        $user1->setTel('06-30-45-65-85');
        $user1->setDescription('Bonjour, je suis Pierre Delarue pratiquant de yoga');
        $user1->setAvatar('img');
        $user1->setSexe('Homme');
        $user1->setNiveau('Confirmé');
        $user1->setSport(1);
        $manager->persist($user1);
        $this->addReference("user1",$user1);


        $user2 = new User();
        $user2->setEmail('guillaumebali@mail.fr');
        $user2->setRoles(array('ROLE_USER'));
        $user2->setIsActive(true);
        $user2->setPassword($this->passwordEncoder->encodePassword($user2, 'password'));
        $user2->setNom('Bali');
        $user2->setPrenom('Guillaume');
        $user2->setAdresse('11 rue Pichon');
        $user2->setCodePostal('76000');
        $user2->setVille('Rouen');
        $user2->setTel('06 30 45 65 85');
        $user2->setDescription('Bonjour, je suis Guillaume Bali et j\'aime le fitness');
        $user2->setAvatar('img');
        $user2->setSexe('Homme');
        $user2->setNiveau('Débutant');
        $user2->setSport(1);
        $manager->persist($user2);
        $this->addReference("user2",$user2);

        $user3 = new User();
        $user3->setEmail('clementmaxime@mail.fr');
        $user3->setRoles(array('ROLE_USER'));
        $user3->setIsActive(true);
        $user3->setPassword($this->passwordEncoder->encodePassword($user3, 'password'));
        $user3->setNom('Clement');
        $user3->setPrenom('Maxime');
        $user3->setAdresse('32 avenue des chênes');
        $user3->setCodePostal('75000');
        $user3->setVille('Paris');
        $user3->setTel('06.58.65.32.14');
        $user3->setDescription('Bonjour, je suis Maxime ! :)');
        $user3->setAvatar('img');
        $user3->setSexe('Homme');
        $user3->setNiveau('Intermediaire');
        $manager->persist($user3);
        $this->addReference("user3",$user3);


        $user4 = new User();
        $user4->setEmail('user4@mail.fr');
        $user4->setRoles(array('ROLE_USER'));
        $user4->setPassword($this->passwordEncoder->encodePassword($user4, 'password'));
        $user4->setNom('Lefevre');
        $user4->setPrenom('Anne');
        $user4->setAdresse('32 avenue du moulin');
        $user4->setCodePostal('75000');
        $user4->setVille('Paris');
        $user4->setTel('06 58 65 32 14');
        $user4->setDescription('Coucou, je suis Anne Lefevre ! :)');
        $user4->setAvatar('img');
        $user4->setSexe('Femme');
        $user4->setNiveau('Confirmé');
        $manager->persist($user4);
        $this->addReference("user4",$user4);

        $user5 = new User();
        $user5->setEmail('user5@mail.fr');
        $user5->setRoles(array('ROLE_USER'));
        $user5->setPassword($this->passwordEncoder->encodePassword($user5, 'password'));
        $user5->setNom('Frite');
        $user5->setPrenom('Stephane');
        $user5->setAdresse('32 avenue de la Frite');
        $user5->setCodePostal('76220');
        $user5->setVille('Dunkerque');
        $user5->setTel('06 58 65 32 14');
        $user5->setDescription('Coucou, je suis Frite Stephane ! :)');
        $user5->setAvatar('img');
        $user5->setSexe('Homme');
        $user5->setNiveau('Confirmé');
        $manager->persist($user5);
        $this->addReference("user5",$user5);


        ////////////////////////////////////////COACH////////////////////////////////////////////

        $coach= new User();
        $coach->setEmail('coach@mail.fr');
        $coach->setRoles(array('ROLE_COACH','ROLE_USER'));
        $coach->setIsActive(true);
        $coach->setPassword($this->passwordEncoder->encodePassword($coach, 'password'));
        $coach->setNom('Legrand');
        $coach->setPrenom('Pierre');
        $coach->setAdresse('32 avenue du havre');
        $coach->setCodePostal('75000');
        $coach->setVille('Paris');
        $coach->setTel('06 58 98 32 14');
        $coach->setDiplome('BPJEPS');
        $coach->setDescription('Coucou, je suis Pierre Legrand coach à domicile ! :)');
        $coach->setAvatar('f204052990b60c6852ca17a3e5fb4d0c.png');
        $coach->setSexe('Homme');
        $manager->persist($coach);
        $this->addReference("coach",$coach);



        $coach2= new User();
        $coach2->setEmail('louisgras@mail.fr');
        $coach2->setRoles(array('ROLE_COACH','ROLE_USER'));
        $coach2->setIsActive(true);
        $coach2->setPassword($this->passwordEncoder->encodePassword($coach2, 'password'));
        $coach2->setNom('Gras');
        $coach2->setPrenom('Louis');
        $coach2->setAdresse('32 avenue souris');
        $coach2->setCodePostal('76000');
        $coach2->setVille('Dieppe');
        $coach2->setTel('06 58 98 32 14');
        $coach2->setDiplome('BPJEPS');
        $coach2->setDescription('Salut, je suis Louis Gras coach de fitness !');
        $coach2->setAvatar('bb542c7afea335223deb8fcdc6f3c994.png');
        $coach2->setSexe('Homme');
        $manager->persist($coach2);
        $this->addReference("coach2",$coach2);


        $coach3= new User();
        $coach3->setEmail('clairemartin@mail.fr');
        $coach3->setRoles(array('ROLE_COACH','ROLE_USER'));
        $coach3->setIsActive(true);
        $coach3->setPassword($this->passwordEncoder->encodePassword($coach3, 'password'));
        $coach3->setNom('Martin');
        $coach3->setPrenom('Claire');
        $coach3->setAdresse('32 rue des marins');
        $coach3->setCodePostal('76000');
        $coach3->setVille('lille');
        $coach3->setTel('06 89 98 90 12');
        $coach3->setDiplome('BPJEPS');
        $coach3->setDescription('Bonjour, je suis Claire Martin coach de yoga !');
        $coach3->setAvatar('592f7e83379a118a56b99e550fe6684f.png');
        $coach3->setSexe('femme');
        $manager->persist($coach3);
        $this->addReference("coach3",$coach3);


        $coach4= new User();
        $coach4->setEmail('coach4@mail.fr');
        $coach4->setRoles(array('ROLE_COACH','ROLE_USER'));
        $coach4->setIsActive(true);
        $coach4->setPassword($this->passwordEncoder->encodePassword($coach4, 'password'));
        $coach4->setNom('Fridel');
        $coach4->setPrenom('Henry');
        $coach4->setAdresse('32 rue des iris');
        $coach4->setCodePostal('76000');
        $coach4->setVille('Arques la Bataille');
        $coach4->setTel('07 89 98 00 56');
        $coach4->setDiplome('BPJEPS');
        $coach4->setDescription('Salut, je suis Henry coach de Judo');
        $coach4->setAvatar('09f89d2665f10d0306d28a86d5a097e4.png');
        $coach4->setSexe('homme');
        $manager->persist($coach4);
        $this->addReference("coach4",$coach4);


        $coach5= new User();
        $coach5->setEmail('elisegrandjacques@mail.fr');
        $coach5->setRoles(array('ROLE_COACH','ROLE_USER'));
        $coach5->setIsActive(true);
        $coach5->setPassword($this->passwordEncoder->encodePassword($coach5, 'password'));
        $coach5->setNom('Grandjacques');
        $coach5->setPrenom('Elise');
        $coach5->setAdresse('322 route des moulins');
        $coach5->setCodePostal('76000');
        $coach5->setVille('Rennes');
        $coach5->setTel('06 76 43 90 17');
        $coach5->setDiplome('BPJEPS');
        $coach5->setDescription('Coucou, je suis Elise Grandjacques coach de pilate ! :)');
        $coach5->setAvatar('1cd0904ac8836e863ae5eb50f9e3947f.png');
        $coach5->setSexe('femme');
        $manager->persist($coach5);
        $this->addReference("coach5",$coach5);

 
        $coach6= new User();
        $coach6->setEmail('stephanieleblond@mail.fr');
        $coach6->setRoles(array('ROLE_COACH','ROLE_USER'));
        $coach6->setPassword($this->passwordEncoder->encodePassword($coach6, 'password'));
        $coach6->setNom('Leblond');
        $coach6->setPrenom('Stéphanie');
        $coach6->setAdresse('322 rue des chemins');
        $coach6->setCodePostal('76000');
        $coach6->setVille('Nantes');
        $coach6->setTel('07 36 43 90 17');
        $coach6->setDiplome('BPJEPS');
        $coach6->setDescription('Coucou, je suis Stéphanie Leblond coach de fitness ! :)');
        $coach6->setAvatar('760946b17d51251edd86554dc95816af.png');
        $coach6->setSexe('femme');
        $manager->persist($coach6);
        $this->addReference("coach6",$coach6);

        $coach7= new User();
        $coach7->setEmail('olivier@mail.fr');
        $coach7->setRoles(array('ROLE_COACH','ROLE_USER'));
        $coach7->setPassword($this->passwordEncoder->encodePassword($coach7, 'password'));
        $coach7->setNom('Laurans');
        $coach7->setPrenom('Oliviers');
        $coach7->setAdresse('17 route de la mer');
        $coach7->setCodePostal('13000');
        $coach7->setVille('Nice');
        $coach7->setTel('06 45 25 69 85');
        $coach7->setDiplome('BPJEPS'); 
        $coach7->setDescription('Coucou, je suis Olivier Laurans coach en running ! :)');
        $coach7->setAvatar('56a88a3e415e1a2d492005d916e153ee.png');
        $coach7->setSexe('homme');
        $manager->persist($coach7);
        $this->addReference("coach7",$coach7);

        $coach8= new User();
        $coach8->setEmail('coachchristine@mail.fr');
        $coach8->setRoles(array('ROLE_COACH','ROLE_USER'));
        $coach8->setPassword($this->passwordEncoder->encodePassword($coach8, 'password'));
        $coach8->setNom('Lenoir');
        $coach8->setPrenom('Christine');
        $coach8->setAdresse('5 impasse des lauriers');
        $coach8->setCodePostal('76000');
        $coach8->setVille('Grenoble');
        $coach8->setTel('07 58 96 32');
        $coach8->setDiplome('BPJEPS'); 
        $coach8->setDescription('Coucou, je suis Christien Lenoir de Streching');
        $coach8->setAvatar('15c57a5cf20637b2f36437bd2356f877.png');
        $coach8->setSexe('Femme');
        $manager->persist($coach8);
        $this->addReference("coach8",$coach8);


        $manager->flush();
    }

}