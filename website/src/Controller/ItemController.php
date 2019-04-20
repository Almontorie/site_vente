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

class ItemController extends AbstractController
{
    /**
     * @return mixed
     * @Route("/item", name="item")
     */

    public function index() : Response
    {
        return $this->render('pages/item.html.twig');
    }
}