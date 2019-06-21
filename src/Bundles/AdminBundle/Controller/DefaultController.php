<?php

namespace App\Bundles\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    public function index(Request $request): Response
    {
        //return $this->render('App\Bundles\AdminBundle:Default:index.html.twig');
        return new Response('Accueil Jobeet - Hello');
    }
}
