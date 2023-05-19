<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Users;
use App\Entity\Salle;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         // Ajoute un utilisateur Admin à la base de données
        
         $admin = new Users();
         $admin->setEmail('karimadmin@admin.com')
               ->setRoles(["ROLE_ADMIN"])
               ->setPassword('$2y$13$aYnsBsxJXQx2oOT.uNO2be8OZosM7qP89y7MZDD4/3LMyoJkeEIN.')
               ->setNom('adm')
               ->setPrenom('karim')
               ->setAdresse('1 rue de la paix')
               ->setCodePostal(95130)
               ->setVille('Franconville')
               ->setTelephone( '06 66 65 66 66');

        //     // Ajoute l'utilisateur à la base de données
        //        $manager->persist($admin);

              $faker = Faker\Factory::create('fr_FR');

        //  Boucle sur les users
          for ($i=1; $i<51; $i++){

            $users = new Users();
            $users->setEmail($faker->email)
                  ->setRoles(["ROLE_USER"])
                  ->setPassword('$2y$13$aYnsBsxJXQx2oOT.uNO2be8OZosM7qP89y7MZDD4/3LMyoJkeEIN.')
                  ->setNom($faker->lastName)
                  ->setPrenom($faker->firstName)
                  ->setAdresse($faker->address)
                  ->setCodePostal($faker->postcode)
                  ->setVille($faker->city)
                  ->setTelephone($faker->phoneNumber);
                   $manager->persist($users);
         }

         // Boucle sur les salles

         for( $j=1; $j< 21; $j++ ){

            $salles = new Salle();
            $salles->setNom('Salle numéro '.$j)
                   ->setDisponible($faker->numberBetween($min = 0, $max = 1))
                   ->setNbPlaces($faker->numberBetween($min = 15, $max = 30))
                   ->setPrixHebdo($faker->numberBetween($min = 200, $max = 1000));
                   $manager->persist($salles);

         }

        $manager->flush();
    }
}
