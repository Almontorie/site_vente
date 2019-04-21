<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{


    /**
     * @Route ("/product/panier/{id}",name="user.panier.add")
     * @param $id
     */
    public function addPanier($id){
        $session=new Session();
        if ($session->has("myVar")) {
            $panier=$session->get('panier');
        }
        else{
            $panier=[];
        }
        $panier[]->$id;
        $session->set("panier",$panier);
        return $this->redirectToRoute('home');
    }

}