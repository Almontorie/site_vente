<?php
/**
 * Created by PhpStorm.
 * User: Alexis
 * Date: 09/04/2019
 * Time: 18:54
 */

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @param ProductRepository $productRepository
     * @return mixed
     * @Route("/", name="home")
     */
    public function index(ProductRepository $productRepository) : Response
    {
        $products = $productRepository->findAll();
        return $this->render('pages/home.html.twig', [
            "products" => $products
        ]);
    }

    /**
     * @Route("/search", name="home.search")
     * @param Request $request
     * @param ProductRepository $productRepository
     * @return Response
     */
    public function search(Request $request, ProductRepository $productRepository)
    {
        $name = $request->get('keyword');
        if(empty($name)){
            return $this->redirectToRoute("home");
        }
        $products = $productRepository->findByName($name);

        if(empty($products)){
            $this->addFlash("Error","Aucun résultat");
        }

        return $this->render('pages/home.html.twig', [
            "products" => $products
        ]);
    }
}
