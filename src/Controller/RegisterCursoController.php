<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterCursoController extends AbstractController
{
    /**
     * @Route("/register/curso", name="app_register_curso")
     */
    public function index(): Response
    {
        return $this->render('register_curso/index.html.twig', [
            'controller_name' => 'RegisterCursoController',
        ]);
    }
}
