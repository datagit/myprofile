<?php
/**
 * Created by PhpStorm.
 * User: ubuntu
 * Date: 28/06/2015
 * Time: 17:20
 */

// src/DataSourceBundle/DataFixtures/ORM/LoadUserData.php
namespace DataSourceBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DataSourceBundle\Entity\User;

class LoadUserData implements FixtureInterface {
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setEmail("admin@mail.com");
        $userAdmin->setStatus(1);
        $userAdmin->setUsername('admin');
        $userAdmin->setPassword('123456');

        $userGuest = new User();
        $userGuest->setEmail("guest@mail.com");
        $userGuest->setStatus(1);
        $userGuest->setUsername('guest');
        $userGuest->setPassword('123456');

        $manager->persist($userGuest);
        $manager->persist($userAdmin);
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}