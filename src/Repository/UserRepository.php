<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */

    public function findAcoach($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.roles LIKE :val')
            ->setParameter('val', '%"'.$value.'"%')
            ->orderBy('u.id', 'DESC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult()
        ;
    }


    public function getcoachWithVille($ville)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.ville = :val')
            ->andWhere('u.roles LIKE :val2')

            ->setParameter('val', $ville)
            ->setParameter('val2', '%ROLE_COACH%')
            ->orderBy('u.id', 'DESC')
            //->setMaxResults(4)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findAcoachSportVille($role,$sportid,$ville )
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.ville = :val')
            ->andWhere('u.roles LIKE :val2')
            ->leftJoin('u.sports','s')
            ->andWhere('s.id = :dede')
            ->setParameter("dede", $sportid)
            ->setParameter('val', $ville)
            ->setParameter('val2', '%"'.$role.'"%')
            ->orderBy('u.id', 'DESC')
            //->setMaxResults(4)
            ->getQuery()
            ->getResult()
            ;
    }


    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
