<?php
namespace App\Controller\Front;

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



class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage", methods={"GET","POST"})
     */
    public function index(Request $request, UserRepository $userRepository){


        $search = new Search();

        $repo = $this->getDoctrine()->getRepository(User::class);
        $user = $repo->findAcoach('ROLE_COACH');

     //   $repo2 = $this->getDoctrine()->getRepository(Sport::class);
    //    $sport = $repo2->findById(1);

      
//        $user = $userRepository->findAll();
        $form = $this->createForm(SearchSportType::class, $search, [
            'action' => $this->generateUrl('recherche')
        ]);

        $form->handleRequest($request);


//        $request->request->get('search_sport')['sport'];

        if ($form->isSubmitted() && $form->isValid()) {


            return $this->redirectToRoute('recherche');
        }

        return $this->render('front/default/index.html.twig',[
        //    'sport' => $sport,
            'form' => $form->createView(),
            'users' => $user
        ]);

    }


//   /**
//    * @Route("/search", name="app_search", methods={"GET"})
//    */
//   public function search(SearchRepository $searchRepository)
//   {
//       $search = new Search();
//       $form = $this->createForm(SearchSportType::class, $search);
//
//       return $this->render('default/_form.html.twig', [
////
////            'sports' => $searchRepository->findAll(),
//           'form' => $form->createView(),
//       ]);
//   }
}
