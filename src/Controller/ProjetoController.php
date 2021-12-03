<?php
namespace App\Controller;

use App\Entity\Funcionario;
use App\Entity\Projeto;
use App\Form\ProjetoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

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
    public function formulario(Request $request, EntityManagerInterface $entityManager){
        $projeto = new Projeto();
        $form = $this->createForm(ProjetoType::class, $projeto);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($projeto);
            $entityManager->flush();

            return $this->redirect("/projeto/lista/");
        }
        return $this->renderForm('Projeto/novo.html.twig',["projeto" => $projeto,"form" => $form]);
    }

    /**
     * @Route("/projeto/lista",methods={"GET"})
     */
    public function lista(EntityManagerInterface $entityManager){
        $repository = $entityManager->getRepository(Projeto::class);

        return $this->render("Projeto/lista.html.twig",["projetos" => $repository->findAll()]);
    }

    /**
     * @Route("/projeto/edita/{id}",methods={"GET", "POST"})
     */
    public function edita(Projeto $projeto, Request $request, EntityManagerInterface $entityManager){
        $form = $this->createForm(ProjetoType::class, $projeto);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($projeto);
            $entityManager->flush();
        }
        return $this->renderForm('Projeto/edita.html.twig',["projeto" => $projeto,"form" => $form]);
    }

    /**
     * @Route("/projeto/remove/{id}", methods={"GET"})
     */
    public function delete(Projeto $projeto, EntityManagerInterface $entityManager){
        $entityManager->remove($projeto);
        $entityManager->flush();

        return $this->redirect("/projeto/lista");
    }
}
