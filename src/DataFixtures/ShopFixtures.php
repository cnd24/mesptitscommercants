<?php

namespace App\DataFixtures;

use App\Entity\Shop;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ShopFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for($i=0; $i<50; $i++){
            $shop = new Shop();
            $shop->setName($faker->company);
            $shop->setPhoneNumber($faker->phoneNumber);
            $shop->setAdress($faker->address);
            $shop->addShopCategory($this->getReference('category_shop'.rand(0, count(CategoryShopFixtures::CATEGORY_SHOP)-1)));
            $manager->persist($shop);
        }

        $manager->flush();
    }
}
