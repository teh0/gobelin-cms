<?php

namespace App\DataFixtures;

use App\Entity\Page;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\This;

class PageFixtures extends BaseFixture implements DependentFixtureInterface
{
    const TOTAL_NUMBER_PAGES = 50;
    const PREFIX_REFERENCE = 'page';
    const NUMBER_CATEGORY_BY_PAGE = 3;

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i < self::TOTAL_NUMBER_PAGES; $i++) {
            $page = new Page();
            $page->setTitle($this->faker->word);
            $page->setContent($this->faker->randomHtml());
            $page->setAuthor($this->getReference(UserFixtures::PREFIX_REFERENCE . '-1'));
            $this->setCategories($page);
            $this->addReference(self::PREFIX_REFERENCE . "-$i", $page);
            $manager->persist($page);
        }

        $manager->flush();
    }


    private function setCategories(Page $page): void
    {
        $categoryReferences = $this->getRandomRelationReferences(
            CategoryFixtures::PREFIX_REFERENCE,
            CategoryFixtures::TOTAL_NUMBER_CATEGORIES,
            self::NUMBER_CATEGORY_BY_PAGE
        );

        foreach ($categoryReferences as $categoryReference) {
            $page->addCategory($this->getReference($categoryReference));
        }
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return [
            UserFixtures::class,
            CategoryFixtures::class
        ];
    }
}
