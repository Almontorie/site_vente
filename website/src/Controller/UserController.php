<?php


namespace App\Controller;


use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{


    /**
     * @Route ("/cart/{id}",name="user.cart.add")
     * @param $id
     * @param ProductRepository $productRepository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addCart($id ,ProductRepository $productRepository){
        $prod=$productRepository->find($id);
        if(!empty($prod)) {
            $session = new Session();
            if ($session->has("cart")) {
                $cart = $session->get('cart');
            } else {
                $cart = [];
            }
            $cart[] = $id;
            $session->set("cart", $cart);
        }

        return $this->redirectToRoute('home');
    }


    /**
     * @Route ("/cart", name="user.cart.show")
     * @param ProductRepository $productRepository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function showCart(ProductRepository $productRepository){
        $session = new Session();
        $total = 0;
        $cart = [];
        if ($session->has("cart")) {
            $ids=$session->get('cart');
            if(!empty($ids)) {
                foreach ($ids as $id) {
                    $item = $productRepository->find($id);
                    $total = $total + $item->getPrice();
                    $cart[] = $item;
                }

                return $this->render('pages/cart.html.twig', [
                    'cart' => $cart,
                    'total' => $total
                ]);
            }
        }
        return $this->redirectToRoute('home');
    }

    /**
     * @Route ("/delete/{id}", name="user.cart.delete")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteProduct($id){
        $session = new Session();

        $cart = $session->get('cart');

        if (($key = array_search($id, $cart)) !== false) {
            unset($cart[$key]);
        }

        $session->set("cart", $cart);
        return $this->redirectToRoute('user.cart.show');
    }
}