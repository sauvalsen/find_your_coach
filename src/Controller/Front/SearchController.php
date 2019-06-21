<?php
namespace App\Controller\Front;

use App\Entity\User;
use App\Entity\Search;
use App\Form\SearchType;
use App\Repository\SearchRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/search")
 */
class SearchController extends AbstractController
{
    /**
     * @Route("/", name="search_index", methods={"GET"})
     */
    public function index(SearchRepository $searchRepository): Response
    {
        return $this->render('front/search/index.html.twig', [
            'searches' => $searchRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="search_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($search);
            $entityManager->flush();

            return $this->redirectToRoute('search_index');
        }

        return $this->render('front/search/new.html.twig', [
            'search' => $search,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="search_show", methods={"GET"})
     */
    public function show(Search $search): Response
    {
        return $this->render('front/search/show.html.twig', [
            'search' => $search,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="search_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Search $search): Response
    {
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('search_index', [
                'id' => $search->getId(),
            ]);
        }

        return $this->render('front/search/edit.html.twig', [
            'search' => $search,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="search_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Search $search): Response
    {
        if ($this->isCsrfTokenValid('delete'.$search->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($search);
            $entityManager->flush();
        }

        return $this->redirectToRoute('search_index');
    }
}
