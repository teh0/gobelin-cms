<?php


namespace App\DataFixtures\Services;


use Faker\Factory;
use Faker\Generator;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class FixtureGenerator implements FixtureGeneratorInterface
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;
    /**
     * @var Generator
     */
    private $faker;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
        $this->faker = Factory::create();
    }

    public function getRandomRelationReferences(string $prefixReference, int $totalReference, int $quantity): array
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

    /**
     * @return UserPasswordEncoderInterface
     */
    public function getEncoder(): UserPasswordEncoderInterface
    {
        return $this->encoder;
    }

    /**
     * @return Generator
     */
    public function getFaker(): Generator
    {
        return $this->faker;
    }


}