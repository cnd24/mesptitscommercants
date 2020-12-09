<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{

    const FACTICE_IMAGES = [
        "https://cdn.pixabay.com/photo/2017/07/16/22/22/bath-oil-2510783_960_720.jpg",
        "https://cdn.pixabay.com/photo/2018/12/10/21/34/winter-boots-3867776_960_720.jpg",
        "https://cdn.pixabay.com/photo/2015/06/25/17/21/smart-watch-821557_960_720.jpg",
        "https://cdn.pixabay.com/photo/2016/11/23/13/46/honey-1852934_960_720.jpg",
        "https://cdn.pixabay.com/photo/2016/01/19/16/49/picture-frames-1149414_960_720.jpg",
        "https://cdn.pixabay.com/photo/2016/05/09/10/16/flowers-1381133_960_720.jpg",
        "https://cdn.pixabay.com/photo/2017/02/16/10/36/tulips-2071058_960_720.jpg",
        "https://cdn.pixabay.com/photo/2019/03/27/16/48/fat-plants-4085400_960_720.jpg",
    ];


    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for($i=0; $i<150; $i++){
            $product = new Product();
            $product->setPicture(self::FACTICE_IMAGES[rand(0, count(self::FACTICE_IMAGES)-1)]);
            $product->setName($faker->sentence(6, true));
            $product->setDescription($faker->sentence());
            $product->setPrice(rand(10,50));
            $product->setInStock($faker->boolean(90));
            $product->setShop($this->getReference('shop'.rand(1,10)));
            $manager->persist($product);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ShopFixtures::class,
        );
    }
}
