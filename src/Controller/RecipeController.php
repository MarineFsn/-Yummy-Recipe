<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class RecipeController extends AbstractController
{
    #[Route('/recipes', name:'app_recipe', methods: ['GET'])]
    public function index(
        RecipeRepository $repository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $recipes = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('pages/recipe/index.html.twig', [
            'recipes' => $recipes,
        ]);
    }

    #[Route('/recipe/new', name:'app_recipe.new', methods:['GET', 'POST'])]
    public function new(
        Request $request, 
        EntityManagerInterface $manager
    ): Response {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType:: class, $recipe);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $recipe =$form->getData();
            $manager->persist($recipe);
            $manager->flush();

            $this->addFlash(
                'success',
                'Your recipe has been added with success!'
            );

            return $this->redirectToRoute('app_recipe');
        }

        return $this->render('pages/recipe/new.html.twig', [
            'form' =>$form->createView()
        ]);
    }

    #[Route('/recipe/edit/{id}', name: 'app_recipe.edit', methods: ['GET', 'POST'])]
    public function edit(
        RecipeRepository $repository,
        int $id,
        Request $request,
        EntityManagerInterface $manager
    ):Response {

        $recipe = $repository->findOneBy(['id'=> $id]);
        $form = $this->createForm(RecipeType::class,$recipe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $recipe = $form->getData();

            
            $manager->persist($recipe);
            $manager->flush();

            $this->addFlash(
                'success',
                'your recipe has been updated with success!'
            );

            return $this->redirectToRoute('app_recipe');
        }

        return $this->render('pages/recipe/edit.html.twig', [
            'form' =>$form->createView()
        ]);
    }

    #[Route('/recipe/delete/{id}', name: 'app_recipe.delete', methods: ['GET'])]
    public function delete(
        RecipeRepository $repository,
        int $id,
        EntityManagerInterface $manager,
    ):Response{

        $recipe = $repository->findOneBy(['id' => $id]);
        $manager->remove($recipe);
        $manager->flush();

        $this->addFlash(
            'success',
            'your recipe has been deleted with success!'
        );

        return $this->redirectToRoute('app_recipe');
    } 
}

