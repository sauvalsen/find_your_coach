<?php
namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MentionsLegalesController extends AbstractController
{
    /**
     * @Route("/mentions_legales", name="mentions_legales")
     */
    public function index()
    {
        return $this->render('front/mentions_legales/index.html.twig');
    }
}
