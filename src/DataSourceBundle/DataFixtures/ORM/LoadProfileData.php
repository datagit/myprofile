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

class LoadProfileData implements FixtureInterface {
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $emails = array();
        for($i = 0; $i < 1000; $i++) {
            $email = Helper::randomEmail();
            $firstName = Helper::randomFirstName();
            $lastName = Helper::randomLastName();
            if( (! in_array($email, $emails)) ) {
                $profile = new Profile();
                $profile->setStatus(1);
                $profile->setEmail( $email );
                $profile->setFirstName($firstName);
                $profile->setLastName($lastName);
                $profile->setPassword('123456');

                $profile->setJobTitle(Helper::randomJobTitle());
                $profile->setSalaryMax(rand(600,1200));
                $profile->setSalaryMIn(rand(200,600));
                $profile->setPhone(rand(1000000000,2000000000));
                $profile->setBirthday(rand(1980,2015));

                $manager->persist($profile);

                $emails[] = $email;
            }
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3; // the order in which fixtures will be loaded
    }
}