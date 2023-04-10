<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker\Factory;

class UserFixtures extends Fixture
{
    public function  __construct(
        private UserPasswordHasherInterface $passwordEncoder,
        private SluggerInterface $slugger
){}

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setPassword($this->passwordEncoder->hashPassword($admin, 'admin'));
        $admin->setEmail('admin@coincoin.fr');
        $admin->setFirstName('Daffy');
        $admin->setLastName('Duck');
        $admin->setAddress('1 rue du coincoin');
        $admin->setZipcode('75000');
        $admin->setCity('QuackVille');
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        $faker = Factory::create('fr_FR');

        for($user = 1; $user <= 5; $user++) {
            $newUser = new User();
            $newUser->setPassword($this->passwordEncoder->hashPassword($newUser, 'user'));
            $newUser->setEmail($faker->email);
            $newUser->setFirstName($faker->firstName);
            $newUser->setLastName($faker->lastName);
            $newUser->setAddress($faker->streetAddress);
            $newUser->setZipcode(str_replace(' ', '', $faker->postcode));
            $newUser->setCity($faker->city);
            $newUser->setRoles(['ROLE_USER']);

            $manager->persist($newUser);
        }

        $manager->flush();
    }
}
