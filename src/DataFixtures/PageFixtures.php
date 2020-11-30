<?php

namespace App\DataFixtures;

use App\Entity\Page;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PageFixtures extends BaseFixture implements DependentFixtureInterface
{
    const TOTAL_NUMBER_PAGES = 50;
    const PREFIX_REFERENCE = 'page';
    const NUMBER_CATEGORY_BY_PAGE = 3;
    const NUMBER_TAG_BY_PAGE = 3;

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= self::TOTAL_NUMBER_PAGES; $i++) {
            $page = new Page();
            $page->setTitle($this->fixtureGenerator->getFaker()->word);
            $page->setContent($this->fixtureGenerator->getFaker()->randomHtml(8,8));
            $page->setAuthor($this->getReference(UserFixtures::PREFIX_REFERENCE . '-1'));
            $page->setDescription($this->fixtureGenerator->getFaker()->text);
            $this->setCategories($page);
            $this->setTags($page);
            $this->addReference(self::PREFIX_REFERENCE . "-$i", $page);
            $manager->persist($page);
        }

        $manager->flush();
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


    private function setCategories(Page $page): void
    {
        $categoryReferences = $this->fixtureGenerator->getRandomRelationReferences(
            CategoryFixtures::PREFIX_REFERENCE,
            CategoryFixtures::TOTAL_NUMBER_CATEGORIES,
            self::NUMBER_CATEGORY_BY_PAGE
        );

        foreach ($categoryReferences as $categoryReference) {
            $page->addCategory($this->getReference($categoryReference));
        }
    }

    private function setTags(Page $page): void
    {
        $tagReferences = $this->fixtureGenerator->getRandomRelationReferences(
            TagFixtures::PREFIX_REFERENCE,
            TagFixtures::TOTAL_NUMBER_TAGS,
            self::NUMBER_TAG_BY_PAGE
        );

        foreach ($tagReferences as $tagReference) {
            $page->addTag($this->getReference($tagReference));
        }
    }
}
