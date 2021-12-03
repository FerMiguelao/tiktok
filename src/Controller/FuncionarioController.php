<?php
namespace App\Controller;

use App\Entity\Funcionario;
use App\Form\FuncionarioType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FuncionarioController extends AbstractController{
    /**
     * @Route("/funcionario/mostra/{id}", methods={"GET"})
     */
    public function mostraaction(Funcionario $funcionario){
        return $this->render('Funcionario/mostra.html.twig',["funcionario" => $funcionario]);
    }

    /**
     * @Route("/funcionario/novo", methods={"GET", "POST"})
     */
    public function formulario(Request $request){
        $funcionario = new Funcionario();
        $form = $this->createForm(FuncionarioType::class, $funcionario);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($funcionario);
            $em->flush();

            return $this->redirect("/funcionario/lista/");
        }
        return $this->renderForm('Funcionario/novo.html.twig',["funcionario" => $funcionario,"form" => $form]);
    }

    /**
     * @Route("/funcionario/lista", methods={"GET"})
     */
    public function lista(){
        $funcionarios = $this->getDoctrine()->getManager()->getRepository(Funcionario::class)->findAll();

        return $this->render('Funcionario/lista.html.twig',["funcionarios" => $funcionarios]);
    }

    /**
     * @Route("funcionario/edita/{id}",methods={"GET", "POST"})
     */
    public function edita(Funcionario $funcionario,Request $request){
        $form = $this->createForm(FuncionarioType::class, $funcionario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($funcionario);
            $em->flush();
        }

        return $this->renderForm('Funcionario/edita.html.twig', ['funcionario' => $funcionario, 'form' => $form]);
    }

    /**
     * @Route("funcionario/remove/{id}", methods={"GET"})
     */
    public function remove(Funcionario $funcionario){
        $em = $this->getDoctrine()->getManager();
        $em->remove($funcionario);
        $em->flush();

        return $this->redirect("/funcionario/lista");
    }
}