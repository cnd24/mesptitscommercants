<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

class UserFixtures extends Fixture
{
     private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $user = new User();
        $user->setEmail('admin@admin.fr');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'admin'));
        $manager->persist($user);

        $user = new User();
        $user->setEmail('shop@admin.fr');
        $user->setRoles(['ROLE_SHOP']);
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'shop'));
        $manager->persist($user);

        $user = new User();
        $user->setEmail('customer@admin.fr');
        $user->setRoles(['ROLE_CUSTOMER']);
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'customer'));
        $manager->persist($user);

        $manager->flush();
    }
}
