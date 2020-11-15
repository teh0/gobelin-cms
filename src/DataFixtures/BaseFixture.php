<?php


namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

abstract class BaseFixture extends Fixture
{
    /**
     * @var Generator
     */
    protected $faker;

    /**
     * @var UserPasswordEncoderInterface
     */
    protected $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->faker = Factory::create();
        $this->encoder = $encoder;
    }

    protected function getRandomRelationReferences(string $prefixReference, int $totalReference, int $quantity)
    {
        $relationReferences = [];
        $rangeIndex = range(1, $totalReference);
        shuffle($rangeIndex);
        $referenceIndex = array_slice($rangeIndex, 0, $quantity);

        foreach ($referenceIndex as $index) {
            $relationReferences[] = $prefixReference . "-$index";
        }

        return $relationReferences;
    }
}