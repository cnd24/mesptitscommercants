<?php

namespace App\DataFixtures;

use App\Entity\ShopCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryShopFixtures extends Fixture
{
    const CATEGORY_SHOP=[
        'Décoration',
        'Fleuriste',
        'Librairie',
        'Habillement',
        'Maroquinerie',
        'Bijouterie'
    ];

    public function load(ObjectManager $manager)
    {
        for($i=0; $i<count(self::CATEGORY_SHOP); $i++){
            $categoryShop = new ShopCategory();
            $categoryShop->setName(self::CATEGORY_SHOP[$i]);
            $this->addReference('category_shop'.$i, $categoryShop);
            $manager->persist($categoryShop);
        }

        $manager->flush();
    }
}
