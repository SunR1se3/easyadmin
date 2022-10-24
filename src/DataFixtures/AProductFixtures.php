<?php

namespace App\DataFixtures;

use App\Entity\Products;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AProductFixtures extends Fixture
{
    public const PRODUCTT_REFERENCE1 = 'product1';
    public const PRODUCTT_REFERENCE2 = 'product2';
    public const PRODUCTT_REFERENCE3 = 'product3';
    public const PRODUCTT_REFERENCE4 = 'product4';

    public function load(ObjectManager $manager): void
    {
        $product1 = new Products();
        $product1->setName("Телефон");
        $product1->setPrice(20000);
        $manager->persist($product1);

        $product2 = new Products();
        $product2->setName("Телевизор");
        $product2->setPrice(50500);
        $manager->persist($product2);

        $product3 = new Products();
        $product3->setName("Ноут");
        $product3->setPrice(35000);
        $manager->persist($product3);

        $product4 = new Products();
        $product4->setName("Мышка");
        $product4->setPrice(3700);
        $manager->persist($product4);

        $manager->flush();

        $this->addReference(self::PRODUCTT_REFERENCE1, $product1);
        $this->addReference(self::PRODUCTT_REFERENCE2, $product2);
        $this->addReference(self::PRODUCTT_REFERENCE3, $product3);
        $this->addReference(self::PRODUCTT_REFERENCE4, $product4);


    }
}
