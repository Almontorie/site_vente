<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{


    /**
     * @Route ("/product/cart/{id}",name="user.cart.add")
     * @param $id
     */
    public function addCart($id){
        $session=new Session();
        if ($session->has("cart")) {
            $cart=$session->get('cart');
        }
        else{
            $cart=[];
        }
        $cart[]->$id;
        $session->set("cart",$cart);
        return $this->redirectToRoute('home');
    }

}