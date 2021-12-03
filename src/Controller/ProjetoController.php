<?php
namespace App\Controller;

use App\Entity\Funcionario;
use App\Entity\Projeto;
use App\Form\ProjetoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProjetoController extends AbstractController{
    /**
     * @Route("/projeto/mostra/{id}",methods={"GET"})
     */
    public function mostraaction(Projeto $projeto){
        return $this->render('Projeto/mostra.html.twig',["projeto" => $projeto]);
    }

    /**
     * @Route("/projeto/novo", methods={"GET", "POST"})
     */
    public function formulario(Request $request){
        $projeto = new Projeto();
        $form = $this->createForm(ProjetoType::class, $projeto);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($projeto);
            $em->flush();

            return $this->redirect("/projeto/lista/");
        }
        return $this->renderForm('Projeto/novo.html.twig',["projeto" => $projeto,"form" => $form]);
    }

    /**
     * @Route("/projeto/lista",methods={"GET"})
     */
    public function lista(){
        $repository = $this->getDoctrine()->getManager()->getRepository(Projeto::class);

        return $this->render("Projeto/lista.html.twig",["projetos" => $repository->findAll()]);
    }

    /**
     * @Route("/projeto/edita/{id}",methods={"GET", "POST"})
     */
    public function edita(Projeto $projeto, Request $request){
        $form = $this->createForm(ProjetoType::class, $projeto);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($projeto);
            $em->flush();
        }
        return $this->renderForm('Projeto/edita.html.twig',["projeto" => $projeto,"form" => $form]);
    }

    /**
     * @Route("/projeto/remove/{id}", methods={"GET"})
     */
    public function delete(Projeto $projeto){
        $em = $this->getDoctrine()->getManager();
        $em->remove($projeto);
        $em->flush();

        return $this->redirect("/projeto/lista");
    }
}
