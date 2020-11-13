<?php

namespace App\DataFixtures;

use App\Entity\Shop;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ShopFixtures extends Fixture
{

    const FACTICE_IMAGES = [
        "https://images.unsplash.com/photo-1479064555552-3ef4979f8908?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80",
        "https://images.unsplash.com/photo-1511556820780-d912e42b4980?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80",
        "https://images.unsplash.com/photo-1517142089942-ba376ce32a2e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80",
        "https://images.unsplash.com/photo-1556228841-fb0779df1db1?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60",
        "https://images.unsplash.com/photo-1531646317777-0619c7c5d1d3?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80",
        "https://images.unsplash.com/photo-1473496169904-658ba7c44d8a?ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80",
        "https://images.unsplash.com/photo-1491637639811-60e2756cc1c7?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=669&q=80",
        "https://images.unsplash.com/photo-1560343090-f0409e92791a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=700&q=80",
        "https://images.unsplash.com/photo-1547418113-4c227895e19f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60",
        "https://images.unsplash.com/photo-1481391319762-47dff72954d9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=701&q=80",
        "https://images.unsplash.com/photo-1591969720392-942fbccecd5a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80",
    ];


    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for($i=0; $i<50; $i++){
            $shop = new Shop();
            $shop->setName($faker->company);
            $shop->setPhoneNumber($faker->phoneNumber);
            $shop->setAdress($faker->address);
            $shop->setPicture(self::FACTICE_IMAGES[rand(0, count(self::FACTICE_IMAGES)-1)]);
            $shop->addShopCategory($this->getReference('category_shop'.rand(0, count(CategoryShopFixtures::CATEGORY_SHOP)-1)));
            $manager->persist($shop);
        }

        $manager->flush();
    }
}
