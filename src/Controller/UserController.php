<?php

namespace App\Controller;

use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    #[Route('/user/edit/{id}', name: 'app_user.edit')]
    public function edit( UserPasswordHasherInterface $hasher, UserRepository $repository, int $id, Request $request, EntityManagerInterface $manager): Response
    {

        $user = $repository->findOneBy(['id' => $id]);

        if($this->getUser()) {
            return $this->redirectToRoute('app_security.login');
        }

        if($this->getUser() !== $user) {

            return $this->redirectToRoute('app_recipe');
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request); 
        
        if ($form->isSubmitted() && $form->isValid()) {
            if ($hasher->isPasswordValid($user, $form->getData()->getPlainPassword())) {

            }
                $user = $form->getData();
                $manager->persist($user);
                $manager->flush();

                $this->addFlash(
                    'success',
                    'your informations has been modified!'
                );

                return $this->redirectToRoute('app_recipe.index');
            }else{
                $this->addFlash(
                    'warning',
                    'The password is not valid!'
                );
            }
                return $this->render('pages/user/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }  
}    