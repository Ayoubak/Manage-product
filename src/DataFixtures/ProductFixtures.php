<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i =1; $i <= 10; $i++) {
            $product = new Product();
            $product->setName('Product' . $i)
                    ->setStorageCapacity(rand(1, 1000))
                    ->setPrice(rand(1, 500))
                    ->setStock(rand(1, 10));

            $manager->persist($product);
        }

        $manager->flush();
    }
}
