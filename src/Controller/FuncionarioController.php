<?php
namespace App\Controller;

use App\Entity\Funcionario;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FuncionarioController extends AbstractController{
    /**
     * @Route("/funcionario/mostra/{id}")
     */
    public function mostraAction(Funcionario $funcionario){
        return $this->render('Funcionario/mostra.html.twig',["funcionario" => $funcionario]);
    }

    /**
     * @Route("/funcionario/novo", methods="GET")
     */
    public function formulario(){
        $form = $this->createFormBuilder(new Funcionario())
            ->add('nome')
            ->add('dataDeNascimento')
            ->add('projeto')
            ->setAction('/funcionario/novo')
            ->getForm();
        return $this->render('Funcionario/novo.html.twig',["form" => $form->createView()]);
    }

    /**
     * @Route("/funcionario/novo",methods="POST")
     */
    public function cria(Request $request){
        $funcionario = new Funcionario();

        $funcionario->setDataDeEntrada(new \DateTime());
        $form = $this->createFormBuilder($funcionario)
            ->add("nome")
            ->add("dataDeNascimento")
            ->add("projeto")
            ->add("dataDeEntrada")
            ->getForm();

        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $em->persist($funcionario);
        $em->flush();

        return $this->redirect("/funcionario/lista/");
    }

    /**
     * @Route("/funcionario/lista")
     */
    public function lista(){
        $funcionarios = $this->getDoctrine()->getManager()->getRepository(Funcionario::class)->findAll();

        return $this->render('Funcionario/lista.html.twig',["funcionarios" => $funcionarios]);
    }

    /**
     * @Route("/funcionario/edita/{id}",methods="GET")
     */
    public function mostra(Funcionario $funcionario){
        $form = $this->createFormBuilder($funcionario)
            ->add("nome")
            ->add("dataDeNascimento")
            ->add("projeto")
            ->getForm();

        return $this->render('Funcionario/edita.html.twig',["funcionario" => $funcionario,"form" => $form->createView()]);
    }

    /**
     * @Route("funcionario/edita/{id}",methods="POST")
     */
    public function edita(Funcionario $funcionario,Request $request){
        $form = $this->createFormBuilder($funcionario)
            ->add("nome")
            ->add("dataDeNascimento")
            ->add("projeto")
            ->getForm();

        $form->handleRequest($request);

        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->merge($funcionario);
            $em->flush();
        }

        return $this->render('Funcionario/edita.html.twig',["funcionario" => $funcionario,"form" => $form->createView()]);
    }

    /**
     * @Route("funcionario/remove/{id}")
     */
    public function remove(Funcionario $funcionario){
        $em = $this->getDoctrine()->getManager();
        $em->remove($funcionario);
        $em->flush();

        return $this->redirect("/funcionario/lista");
    }
}