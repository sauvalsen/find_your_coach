<?php
namespace App\Controller\Front;

use App\Entity\User;
use App\Entity\Calendrier;
use App\Form\CalendrierType;
use App\Repository\CalendrierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/calendrier")
 */
class CalendrierFrontController extends AbstractController
{
     /**
     * @Route("/new", name="front_calendrier_index", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {  
        
      
        $calendrier = new Calendrier();
        $form = $this->createForm(CalendrierType::class, $calendrier);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
     
     

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($calendrier);
            $entityManager->flush();
        }
 


        return $this->render('front/calendrier_front/index.html.twig', [
            'calendrier' => $calendrier,
            'form' => $form->createView(),
        ]);
    }
}    