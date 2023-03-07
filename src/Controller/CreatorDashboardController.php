<?php

namespace App\Controller;

use App\Entity\Curso;
use App\Form\RegisterCursoType;
use App\Repository\CursoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreatorDashboardController extends AbstractController
{
    /**
     * @Route("/creator/dashboard", name="app_creator_dashboard")
     */
    public function index(Request $request, CursoRepository $cursosRep): Response
    {
        
        return $this->render('creator_dashboard/index.html.twig', [
            'listaCursos' => $cursosRep->findAll(),
        ]);
    }
    /**
     * @Route("/creator/dashboard/register", name="app_creator_dashboard_register")
     */
    public function register(Request $request, CursoRepository $cursosRep): Response
    {
        // $user = $request->getUser();
        $curso = new Curso();
        $form = $this->createForm(RegisterCursoType::class, $curso);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid())
        {
            $curso = $form->getData();
            $curso->setIdUsuario(5);
            $curso->setEstado("EnConstruccion");
            $cursosRep->add($curso,true);
            //$this->addFlash("success","Registro de curso Exitoso");
            return $this->redirectToRoute('app_creator_dashboard');
        }
        return $this->render('creator_dashboard/registerCurso.html.twig', [
            'formulario' => $form->createView(),
        ]);
    }

}
