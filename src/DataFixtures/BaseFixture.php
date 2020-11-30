<?php


namespace App\DataFixtures;


use App\DataFixtures\Services\FixtureGeneratorInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

abstract class BaseFixture extends Fixture
{
    /**
     * @var FixtureGeneratorInterface
     */
    protected $fixtureGenerator;

    public function __construct(FixtureGeneratorInterface $fixtureGenerator)
    {

        $this->fixtureGenerator = $fixtureGenerator;
    }
}