<?php

namespace App\Controller;

use App\Entity\Search;
use App\Entity\User;
use App\Form\SearchSportType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SearchRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage", methods={"GET","POST"})
     */
    public function index(UserRepository $userRepository){

        $search = new Search();
        $repo = $this->getDoctrine()->getRepository(User::class);
        $user = $repo->findAcoach('ROLE_COACH');
//        $user = $userRepository->findAll();
        $form = $this->createForm(SearchSportType::class, $search);
        return $this->render('default/index.html.twig',[
            //'sports' => $searchRepository->findAll(),
            'form' => $form->createView(),
            'users' => $user
        ]);

    }

//    /**
//     * @Route("/serarch", name="app_search", methods={"GET"})
//     */
//    public function search(SearchRepository $searchRepository)
//    {
//        $search = new Search();
//        $form = $this->createForm(SearchSportType::class, $search);
//
//        return $this->render('default/_form.html.twig', [
////
////            'sports' => $searchRepository->findAll(),
//            'form' => $form->createView(),
//        ]);
//    }
}
