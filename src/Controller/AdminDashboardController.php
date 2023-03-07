<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
class AdminDashboardController extends AbstractController
{
    /**
     * @Route("/admin/dashboard", name="app_admin_dashboard")
     */
    public function index(UserRepository $userRepos): Response
    {
        $arrayUser = array();
        $arrayUser = array_merge($userRepos->findByUsersRole(User::ROLE_CREATOR),
                                $userRepos->findByUsersRole(User::ROLE_CONSUMER) );
        return $this->render('admin_dashboard/index.html.twig', [
            'listaUsers' => $arrayUser,
        ]);
    }
}
