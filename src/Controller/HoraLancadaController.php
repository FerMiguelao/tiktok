<?php
namespace App\Controller;

use App\Entity\Funcionario;
use App\Entity\HoraLancada;
use App\Form\FuncionarioType;
use App\Form\HoraLancadaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
    public function formulario(Request $request){
        $horaLancada = new HoraLancada();
        $form = $this->createForm(HoraLancadaType::class, $horaLancada);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($horaLancada);
            $em->flush();

            return $this->redirect("/horaLancada/lista/");
        }
        return $this->renderForm('HoraLancada/novo.html.twig',["horaLancada" => $horaLancada,"form" => $form]);
    }

    /**
     * @Route("/horaLancada/lista", methods={"GET"})
     */
    public function lista(){
        $repository = $this->getDoctrine()->getManager()->getRepository(HoraLancada::class);

        return $this->render("HoraLancada/lista.html.twig",["horasLancadas" => $repository->findAll()]);
    }

    /**
     * @Route("horaLancada/edita/{id}",methods={"GET", "POST"})
     */
    public function edita(HoraLancada $horaLancada,Request $request){
        $form = $this->createForm(HoraLancadaType::class, $horaLancada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($horaLancada);
            $em->flush();
        }

        return $this->renderForm('HoraLancada/edita.html.twig', ['horaLancada' => $horaLancada, 'form' => $form]);
    }

    /**
     * @Route("/horaLancada/remove/{id}", methods={"GET"})
     */
    public function delete(HoraLancada $projeto){
        $em = $this->getDoctrine()->getManager();
        $em->remove($projeto);
        $em->flush();

        return $this->redirect("/horaLancada/lista");
    }
}