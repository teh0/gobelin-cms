<?php


namespace App\DataFixtures\Services;


use Faker\Generator;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

interface FixtureGeneratorInterface
{
    public function getRandomRelationReferences(string $prefixReference, int $totalReference, int $quantity): array;

    public function getEncoder(): UserPasswordEncoderInterface;

    public function getFaker(): Generator;
}