<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Publication;
use App\Entity\User;
use App\Entity\Commentaire;
use App\Entity\Reaction;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       
         $user = $manager->getRepository(User::class)->findOneBy([]); // Prend le premier utilisateur trouvé

       
        if (!$user) {
            $user = new User();
            $user->setEmail('demo@example.com');
            $user->setFirstname('Demo');
            $user->setLastname('User');
            $user->setPassword('password'); 
            $manager->persist($user);

        }

        //creation des publications fictives
        for ($i = 1; $i <= 10; $i++) {
            $publication = new Publication();
            $publication->setContenu('Ceci est le contenu de la publication numéro ' . $i . '.');
            $publication->setDatePub(new \DateTime(sprintf('-%d days', $i)));
            $publication->setIdUser($user);

            $manager->persist($publication);
        }


        $manager->flush();
    }
}
