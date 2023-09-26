<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_security.login', methods: ['GET','POST'])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('pages/security/login.html.twig', [
            'lastUsername' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError()
        ]);

    }

    #[Route('/logout', name: 'app_security.logout')]
    public function logout()
    {
        
    }

    #[Route('/registration', name: 'app_security.registration' , methods:['GET','POST'])]
    public function registration() : Response
    {
        return $this->render('pages/security/registration.html.twig');
    }
}
