<?php
namespace App\Controller;

use App\Entity\Funcionario;
use App\Form\FuncionarioType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

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
    public function formulario(Request $request, EntityManagerInterface $entityManager){
        $funcionario = new Funcionario();
        $form = $this->createForm(FuncionarioType::class, $funcionario);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($funcionario);
            $entityManager->flush();

            return $this->redirect("/funcionario/lista/");
        }
        return $this->renderForm('Funcionario/novo.html.twig',["funcionario" => $funcionario,"form" => $form]);
    }

    /**
     * @Route("/funcionario/lista", methods={"GET"})
     */
    public function lista(EntityManagerInterface $entityManager){
        $funcionarios = $entityManager->getRepository(Funcionario::class)->findAll();

        return $this->render('Funcionario/lista.html.twig',["funcionarios" => $funcionarios]);
    }

    /**
     * @Route("funcionario/edita/{id}",methods={"GET", "POST"})
     */
    public function edita(Funcionario $funcionario,Request $request, EntityManagerInterface $entityManager){
        $form = $this->createForm(FuncionarioType::class, $funcionario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($funcionario);
            $entityManager->flush();
        }

        return $this->renderForm('Funcionario/edita.html.twig', ['funcionario' => $funcionario, 'form' => $form]);
    }

    /**
     * @Route("funcionario/remove/{id}", methods={"GET"})
     */
    public function remove(Funcionario $funcionario, EntityManagerInterface $entityManager){
        $entityManager->remove($funcionario);
        $entityManager->flush();

        return $this->redirect("/funcionario/lista");
    }
}