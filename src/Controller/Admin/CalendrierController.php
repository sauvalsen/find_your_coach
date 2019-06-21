<?php
namespace App\Controller\Admin;

use App\Entity\Calendrier;
use App\Form\CalendrierType;
use App\Repository\CalendrierRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/calendrier")
 */
class CalendrierController extends AbstractController
{
    /**
     * @Route("/", name="admin_calendrier_index", methods={"GET"})
     */
    public function index(calendrierRepository $calendrierRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $calendriers = $paginator->paginate(
            $calendrierRepository->findAll(),
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('admin/calendrier/index.html.twig', [
            'calendriers' => $calendriers,
        ]);
    }

    /**
     * @Route("/new", name="admin_calendrier_new", methods={"GET","POST"})
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
            
            return $this->redirectToRoute('calendrier_index');
        }
 


        return $this->render('admin/calendrier/new.html.twig', [
            'calendrier' => $calendrier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_calendrier_show", methods={"GET"})
     */
    public function show(Calendrier $calendrier): Response
    {
        return $this->render('admin/calendrier/show.html.twig', [
            'calendrier' => $calendrier,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_calendrier_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Calendrier $calendrier): Response
    {
        $form = $this->createForm(CalendrierType::class, $calendrier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('calendrier_index', [
                'id' => $calendrier->getId(),
            ]);
        }

        return $this->render('admin/calendrier/edit.html.twig', [
            'calendrier' => $calendrier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_calendrier_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Calendrier $calendrier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$calendrier->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($calendrier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('calendrier_index');
    }
}
