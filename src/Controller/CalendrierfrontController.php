<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\Calendrier;
use App\Form\CalendrierType;
use App\Repository\CalendrierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/fontcalendrier")
 */
class CalendrierfrontController extends AbstractController
{
    /**
     * @Route("/", name="calendrier_index", methods={"GET"})
     */
    public function index(CalendrierRepository $calendrierRepository): Response
    {
        return $this->render('calendrier/index.html.twig', [
            'calendriers' => $calendrierRepository->findAll(),
        ]);
    }
}