<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends BaseFixture
{
    const TOTAL_NUMBER_TAGS = 10;
    const PREFIX_REFERENCE = 'tag';

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= self::TOTAL_NUMBER_TAGS; $i++) {
            $tag = new Tag();
            $tag->setName($this->faker->word);
            $tag->setColor($this->faker->hexColor);
            $this->addReference(self::PREFIX_REFERENCE . "-$i", $tag);
            $manager->persist($tag);
        }

        $manager->flush();
    }
}
