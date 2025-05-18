<?php

namespace App\DataFixtures;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Publication;
use App\Entity\User;
use App\Entity\Commentaire;
use App\Entity\Reaction;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AppFixtures extends Fixture
{
     private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
       
         $user = $manager->getRepository(User::class)->findOneBy([]); 

    
        $users = [];
        for ($i = 1; $i <= 10; $i++) {
    $user = new User();
    $user->setEmail("demo{$i}@example.com");
    $user->setFirstname('Demo');
    $user->setLastname('User');
    $hashedPassword = $this->passwordHasher->hashPassword($user, 'password');
    $user->setPassword($hashedPassword);
    $manager->persist($user);
        $users[] = $user;
    }

    $admin = new User();
    $admin->setEmail('admin@example.com');
    $admin->setFirstname('Admin');
    $admin->setLastname('Admin');
    $hashedPassword = $this->passwordHasher->hashPassword($admin, '1234');
    $admin->setPassword($hashedPassword);
    $admin->setRoles(['ROLE_ADMIN']);
    $manager->persist($admin);


        $publications = [];
for ($i = 1; $i <= 10; $i++) {
    $publication = new Publication();
    $publication->setContenu('Ceci est le contenu de la publication numéro ' . $i . '.');
    $publication->setDatePub(new \DateTime(sprintf('-%d days', $i)));
    $publication->setIdUser($users[array_rand($users)]);
    $manager->persist($publication);
    $publications[] = $publication;
}

for ($i = 1; $i <= 20; $i++) {
    $commentaire = new Commentaire();
    $commentaire->setContenu('Ceci est le commentaire numéro ' . $i . '.');
    $commentaire->setDateCommentaire(new \DateTime(sprintf('-%d days', rand(1, 30))));
    $commentaire->setIdUser($users[array_rand($users)]); 
    $commentaire->setIdPub($publications[array_rand($publications)]); 
    $manager->persist($commentaire);
}



        $manager->flush();
    }
}


