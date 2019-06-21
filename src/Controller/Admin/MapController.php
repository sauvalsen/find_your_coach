<?php
namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MapController extends AbstractController
{
    /**
     * @Route("/admin/map", name="map")
     */
    public function index()
    {
        return $this->render('admin/map/index.html.twig');
    }
}
