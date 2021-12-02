<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{
    //Tratamento de rotas com annotation
    /**
     * @Route("/")
     */
    public function indexAction(){
        return $this->render('index.html.twig');
    }
}
