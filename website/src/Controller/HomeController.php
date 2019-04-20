<?php
/**
 * Created by PhpStorm.
 * User: Alexis
 * Date: 09/04/2019
 * Time: 18:54
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @return mixed
     * @Route("/", name="home")
     */
    public function index() : Response
    {
        return $this->render('pages/home.html.twig');
    }
}