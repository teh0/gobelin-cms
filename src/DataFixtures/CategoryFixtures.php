<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends BaseFixture
{
    const TOTAL_NUMBER_CATEGORIES = 20;
    const PREFIX_REFERENCE = 'categ';

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= self::TOTAL_NUMBER_CATEGORIES; $i++) {
            $category = new Category();
            $category->setName($this->faker->word);
            $this->addReference(self::PREFIX_REFERENCE . "-$i", $category);
            $manager->persist($category);
        }

        $manager->flush();
    }
}
