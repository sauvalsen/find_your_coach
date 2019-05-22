<?php

namespace App\Controller;

use App\Entity\Search;
use App\Entity\User;
use App\Entity\Sport;
use App\Form\SearchSportType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SearchRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CoachController extends AbstractController
{
    /**
     * @Route("/recherche", name="recherche")
     */
    public function index(Request $request, UserRepository $userRepository)
    {

        $coach1 = $request->request->get('search_sport')['sport'];
        $coach2 = $request->request->get('search_sport')['ville'];

//        dd($coach1,$coach2);

//            $content = $request->getContent();
//            return new Response($content);


        $request = Request::createFromGlobals();
//       dd($coach);

        $search = new Search();
        $repo = $this->getDoctrine()->getRepository(User::class);
        $user = $repo->findAcoach('ROLE_COACH');
//        $user = $userRepository->findAll();
        $form = $this->createForm(SearchSportType::class, $search);
        $form->handleRequest($request);
        return $this->render('coach/index.html.twig',[
            //'sports' => $searchRepository->findAll(),
            'form' => $form->createView(),
            'users' => $user
        ]);
    }
}
