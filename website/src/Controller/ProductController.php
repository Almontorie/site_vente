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
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @Route("/product/add", name="add_product")
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
     * @Route("/product/new", name="add_product.new")
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

}