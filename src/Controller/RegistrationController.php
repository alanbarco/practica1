<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrateUserType;
use App\Form\RegistrationFormType;
use App\Security\AppCustomAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, AppCustomAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');
        $user = new User(User::ROLE_CONSUMER,"Consumidor");
        $form = $this->createForm(RegistrateUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            if($this->isGranted(User::ROLE_ADMIN)){
                $user->setRoles([User::ROLE_CREATOR]);
                $user->setTipo("Creador");
            }

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email
            if($this->isGranted(User::ROLE_ADMIN)){
                return $this->redirectToRoute('app_admin_dashboard');
            }else{
                return $this->redirectToRoute('app_login');
            }
        }
        return $this->render('registration/register.html.twig', [
            'formulario' => $form->createView(),
        ]);
    }
}
