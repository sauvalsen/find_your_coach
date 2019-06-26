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

class CoachController extends AbstractController
{
    /**
     * @Route("/recherche", name="recherche")
     */
    public function index(Request $request, UserRepository $userRepository)
    {
        $search = new Search();

        $sportid = $request->request->get('search_sport')['sport'];
        $villeid = $request->request->get('search_sport')['ville'];



        $repo = $this->getDoctrine()->getRepository(Sport::class);

        if(!empty($sportid) && !empty($villeid)) {
            // request special qui va chercher les coach de ce sport et de cette ville
            $userbis = $userRepository->find($villeid);
            $ville = $userbis->getVille();

           $coach = $userRepository->findAcoachSportVille('ROLE_COACH',$sportid,$ville );
        }
        elseif(!empty($sportid)) {
            $sport = $repo->find($sportid);
            $coach = $sport->getUsers();

        }
        elseif(!empty($villeid)) {
            $userbis = $userRepository->find($villeid);
            $ville = $userbis->getVille();
            if(!empty($ville)) {
                $coach = $userRepository->getcoachWithVille($ville);
            }
        }
        else{
            $repo = $this->getDoctrine()->getRepository(User::class);
            $coach = $repo->findAcoach('ROLE_COACH');
        }

//        $user = $userRepository->findAll();
        $form = $this->createForm(SearchSportType::class, $search);
//        $form->handleRequest($request);

        return $this->render('front/coach/index.html.twig',[
            'form' => $form->createView(),
            'users' => $coach,
//            'sport' => $sport,

        ]);
    }
}
