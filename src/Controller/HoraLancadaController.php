<?php
namespace App\Controller;

use App\Entity\Funcionario;
use App\Entity\HoraLancada;
use App\Form\FuncionarioType;
use App\Form\HoraLancadaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


class HoraLancadaController extends AbstractController{
    /**
     * @Route("/horaLancada/mostra/{id}", methods={"GET"})
     */
    public function mostraaction(HoraLancada $horaLancada){
        return $this->render('HoraLancada/mostra.html.twig',["horaLancada" => $horaLancada]);
    }

    /**
     * @Route("/horaLancada/novo", methods={"GET", "POST"})
     */
    public function formulario(Request $request, EntityManagerInterface $entityManager){
        $horaLancada = new HoraLancada();
        $form = $this->createForm(HoraLancadaType::class, $horaLancada);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($horaLancada);
            $entityManager->flush();

            return $this->redirect("/horaLancada/lista/");
        }
        return $this->renderForm('HoraLancada/novo.html.twig',["horaLancada" => $horaLancada,"form" => $form]);
    }

    /**
     * @Route("/horaLancada/lista", methods={"GET"})
     */
    public function lista(EntityManagerInterface $entityManager){
        $repository = $entityManager->getRepository(HoraLancada::class);

        return $this->render("HoraLancada/lista.html.twig",["horasLancadas" => $repository->findAll()]);
    }

    /**
     * @Route("horaLancada/edita/{id}",methods={"GET", "POST"})
     */
    public function edita(HoraLancada $horaLancada,Request $request, EntityManagerInterface $entityManager){
        $form = $this->createForm(HoraLancadaType::class, $horaLancada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($horaLancada);
            $entityManager->flush();
        }

        return $this->renderForm('HoraLancada/edita.html.twig', ['horaLancada' => $horaLancada, 'form' => $form]);
    }

    /**
     * @Route("/horaLancada/remove/{id}", methods={"GET"})
     */
    public function delete(HoraLancada $horaLancada, EntityManagerInterface $entityManager){
        $entityManager->remove($horaLancada);
        $entityManager->flush();

        return $this->redirect("/horaLancada/lista");
    }
}