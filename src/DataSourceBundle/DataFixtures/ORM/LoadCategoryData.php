<?php
/**
 * Created by PhpStorm.
 * User: ubuntu
 * Date: 28/06/2015
 * Time: 17:20
 */

// src/DataSourceBundle/DataFixtures/ORM/LoadCategoryData.php
namespace DataSourceBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DataSourceBundle\Entity\Category;

class LoadCategoryData implements FixtureInterface {
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $php = new Category();
        $php->setName("php");

        $javaWeb = new Category();
        $javaWeb->setName("java-web");

        $javaAndroid = new Category();
        $javaAndroid->setName("java-android");

        $dotNet = new Category();
        $dotNet->setName("dot-net");

        $manager->persist($php);
        $manager->persist($javaWeb);
        $manager->persist($javaAndroid);
        $manager->persist($dotNet);
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }

}