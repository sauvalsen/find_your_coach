<?php

namespace App\Controller\Admin;
use App\Entity\User;
use App\Entity\Sport;
use App\Form\SportType;
use App\Repository\SportRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/sport")
 */
class SportController extends AbstractController
{
    /**
     * @Route("/", name="admin_sport_index", methods={"GET"})
     */
    public function index(SportRepository $sportRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $sports = $paginator->paginate(
            $sportRepository->findAll(),
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('admin/sport/index.html.twig', [
            'sports' => $sports,
        ]);
    }

    /**
     * @Route("/new", name="admin_sport_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sport = new Sport();
        $form = $this->createForm(SportType::class, $sport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sport);
            $entityManager->flush();

            return $this->redirectToRoute('sport_index');
        }

        return $this->render('admin/sport/new.html.twig', [
            'sport' => $sport,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_sport_show", methods={"GET"})
     */
    public function show(Sport $sport): Response
    {
        return $this->render('admin/sport/show.html.twig', [
            'sport' => $sport,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_sport_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Sport $sport): Response
    {
        $form = $this->createForm(SportType::class, $sport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sport_index', [
                'id' => $sport->getId(),
            ]);
        }

        return $this->render('admin/sport/edit.html.twig', [
            'sport' => $sport,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_sport_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Sport $sport): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sport->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sport);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sport_index');
    }
}
