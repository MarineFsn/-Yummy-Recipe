<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Faker\Generator;
use App\Entity\Recipe;
use App\Entity\Ingredient;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;


class AppFixtures extends Fixture
{
    private Generator $faker;

    

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }


    public function load(ObjectManager $manager): void
    {
        $ingredients = [];
        for ($i = 0; $i < 50; $i++) {
            $ingredient = new Ingredient();
            $ingredient->setName($this->faker->word())
                ->setPrice(mt_rand(0, 100));

            $ingredients[] = $ingredient;
            $manager->persist($ingredient);
        }

        for ($i=0; $i < 25 ; $i++) { 
            $recipe = new Recipe();
            $recipe->setName($this->faker->word())
            ->setTime(mt_rand(0,1) == 1 ? mt_rand(1,1440) : 0)
            ->setNbPoeple(mt_rand(0,1) == 1? mt_rand(1,50) : 0)
            ->setDifficulty(mt_rand(0,1) == 1? mt_rand(1,5) : 0)
            ->setDescription($this->faker->text(300))
            ->setPrice(mt_rand(0,1) == 1? mt_rand(0,1000) : 0)
            ->setIsFavorite(mt_rand(0,1) == 1? true : false);

            for ($k=0; $k < mt_rand(5,15) ; $k++) { 
                $recipe->addIngredient($ingredients[mt_rand(0,count($ingredients) -1)]);
            }

            $manager->persist($recipe);
        }

        for ($i=0; $i < 10 ; $i++) { 
            $user = new User();
            $user->setFullName($this->faker->name())
                ->setNickName(mt_rand(0,1) === 1 ? $this->faker->firstName() : '')
                ->setEmail($this->faker->email())
                ->setRoles(['ROLE_USER'])
                ->setPlainPassword('password');

            $manager->persist($user);        
    }       

        $manager->flush();

    }

}
