<?php
/**
 * Created by PhpStorm.
 * User: ubuntu
 * Date: 28/06/2015
 * Time: 17:20
 */

// src/DataSourceBundle/DataFixtures/ORM/LoadProfileData.php
namespace DataSourceBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DataSourceBundle\Entity\Profile;
use DataSourceBundle\Utilities\Helper;
use DataSourceBundle\Entity\Activity;

class LoadActivityData implements FixtureInterface {
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        //load profile
        $profiles = $manager->getRepository('DataSourceBundle:Profile')
            ->findAll();
        //building Activity
        foreach ($profiles as $p) {
            $num = rand(0, 5);
            if($num == 0) {
                continue;
            }
            for($i = 0; $i < $num; $i++) {
                $activity = new Activity();
                $activity->setProfileActivity($p);
                $activity->setStatus(1);
                $activity->setDescription(Helper::generateRandomString());
                $activity->setTitle(Helper::randomActivity());

                $manager->persist($activity);
            }
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 4; // the order in which fixtures will be loaded
    }

}