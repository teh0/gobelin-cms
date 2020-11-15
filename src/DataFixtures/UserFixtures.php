<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Utils\Constants\Role;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends BaseFixture
{
    /* Constants configurations */
    const USER_PASSWORD = 'secretsecret';
    const NUMBER_ADMIN_USERS = 2;
    const TOTAL_NUMBER_USERS = 10;
    const PREFIX_REFERENCE = 'user';

    private $countAdmin = 0;

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= self::TOTAL_NUMBER_USERS; $i++) {
            $user = new User();
            $user->setEmail("user$i@mail.com");
            $user->setName($this->faker->name);
            $user->setPseudo($this->faker->userName);
            $user->setPseudo($this->faker->userName);
            $user->setPassword($this->encoder->encodePassword($user, self::USER_PASSWORD));
            $user->addRole($this->userRole($user));
            $user->setIsVerified(true);
            $this->addReference(self::PREFIX_REFERENCE . "-$i", $user);
            $manager->persist($user);
        }

        $manager->flush();
    }

    private function userRole(User $user): string
    {
        $role = Role::USER_VALIDATED;
        if ($this->countAdmin < self::NUMBER_ADMIN_USERS) {
            $role = Role::ADMIN;
            $this->countAdmin++;
        }

        return $role;
    }
}
