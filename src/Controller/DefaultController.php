<?php

namespace App\Controller;

use App\Entity\Search;
use App\Form\SearchSportType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SearchRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage", methods={"GET"})
     */
    public function index(){

        $search = new Search();
        $form = $this->createForm(SearchSportType::class, $search);
        return $this->render('default/index.html.twig',[

//        'sports' => $searchRepository->findAll(),
        'form' => $form->createView(),
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
