<?php

namespace App\DataFixtures;

use App\Entity\MicroPost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($i = 0; $i < 10; $i++) {
            $microPost = new MicroPost();
            $microPost->setText("Some random text " . rand(0, 100));
            $microPost->setTime(new \DateTime('2020-01-01'));
            $manager->persist($microPost);
        }

        $manager->flush();
    }
}
