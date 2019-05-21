<?php

namespace App\Controller;

use App\Entity\Calendrier;
use App\Entity\User;
use App\Form\EditUserType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class CompteController extends AbstractController
{
    /**
     * @Route("/compte", name="compte")
     */
    public function index()
    {
        return $this->render('compte/index.html.twig', [
            'controller_name' => 'CompteController',
        ]);
    }


    /**
     * @Route("/{id}", name="compte_show", methods={"GET"})
     */
    public function show(User $user): Response
    {

        return $this->render('compte/index.html.twig', [
            'user' => $user,
        ]);
    }
}
