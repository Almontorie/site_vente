<?php
/**
 * Created by PhpStorm.
 * User: Alexis
 * Date: 19/04/2019
 * Time: 22:08
 */

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractController
{

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @Route("/products/add", name="products.add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request){
        $property = new Product();
        $form = $this->createForm(ProductType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->objectManager->persist($property);
            $this->objectManager->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('pages/add_product.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/products/new", name="products.add.new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request){
        $property = new Product();
        $form = $this->createForm(ProductType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->objectManager->persist($property);
            $this->objectManager->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('pages/add_product.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/products/{id}/view", name="product.view")
     * @param $id
     * @param ProductRepository $productRepository
     * @return Response
     */
    public function viewProduct($id, ProductRepository $productRepository) {
        $product = $productRepository->find($id);
        if(empty($product)){
            return $this->redirectToRoute('home');
        }
        return $this->render('pages/product.html.twig', [
            'product'=> $product
        ]);
    }

}