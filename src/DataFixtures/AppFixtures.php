<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail("admin@admin.com");
        $admin->setNombres("Mark");
        $admin->setApellidos("Zuckerberg");
        $admin->setPassword(12345678);
        $admin->setRoles(["ROLE_ADMIN"]);
        $manager->persist($admin);
        $manager->flush();
    }
}
