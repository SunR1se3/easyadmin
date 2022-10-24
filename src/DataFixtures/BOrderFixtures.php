<?php

namespace App\DataFixtures;

use App\Entity\Orders;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BOrderFixtures extends Fixture
{
    public const ORDER_REFERENCE1 = 'order1';
    public const ORDER_REFERENCE2 = 'order2';
    public const ORDER_REFERENCE3 = 'order3';
    public const ORDER_REFERENCE4 = 'order4';
    public const ORDER_REFERENCE5 = 'order5';

    public function load(ObjectManager $manager): void
    {
        $order1 = new Orders();
        $order1->setSum(5555);
        $order1->setStatus(1);
        $order1->addProduct($this->getReference(AProductFixtures::PRODUCTT_REFERENCE1));
        $order1->addProduct($this->getReference(AProductFixtures::PRODUCTT_REFERENCE2));
        $manager->persist($order1);

        $order2 = new Orders();
        $order2->setSum(845);
        $order2->setStatus(2);
        $order2->addProduct($this->getReference(AProductFixtures::PRODUCTT_REFERENCE3));
        $order2->addProduct($this->getReference(AProductFixtures::PRODUCTT_REFERENCE2));
        $order2->addProduct($this->getReference(AProductFixtures::PRODUCTT_REFERENCE1));
        $manager->persist($order2);

        $order3 = new Orders();
        $order3->setSum(749);
        $order3->setStatus(4);
        $order3->addProduct($this->getReference(AProductFixtures::PRODUCTT_REFERENCE2));
        $order3->addProduct($this->getReference(AProductFixtures::PRODUCTT_REFERENCE1));
        $manager->persist($order3);

        $order4 = new Orders();
        $order4->setSum(1250);
        $order4->setStatus(3);
        $order4->addProduct($this->getReference(AProductFixtures::PRODUCTT_REFERENCE4));
        $order4->addProduct($this->getReference(AProductFixtures::PRODUCTT_REFERENCE3));
        $manager->persist($order4);

        $order5 = new Orders();
        $order5->setSum(2500);
        $order5->setStatus(1);
        $order5->addProduct($this->getReference(AProductFixtures::PRODUCTT_REFERENCE4));
        $order5->addProduct($this->getReference(AProductFixtures::PRODUCTT_REFERENCE2));
        $manager->persist($order5);

        $manager->flush();

//        $this->addReference(self::ORDER_REFERENCE1, $order1);
//        $this->addReference(self::ORDER_REFERENCE2, $order2);
//        $this->addReference(self::ORDER_REFERENCE3, $order3);
//        $this->addReference(self::ORDER_REFERENCE4, $order4);
//        $this->addReference(self::ORDER_REFERENCE5, $order5);
    }
}
