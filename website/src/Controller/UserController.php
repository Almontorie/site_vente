<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{


    /**
     * @Route ("/cart/{id}",name="user.cart.add")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addCart($id){
        $session=new Session();
        if ($session->has("cart")) {
            $cart=$session->get('cart');
        }
        else{
            $cart=[];
        }
        $cart[]=$id;
        $session->set("cart",$cart);
        return $this->redirectToRoute('home');
    }


    /**
     * @Route ("/cart/show", name="user.cart.show")
     */
    public function showCart(){
        return $this->render('pages/cart.html.twig');
    }
}