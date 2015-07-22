<?php
/**
 * Created by PhpStorm.
 * User: dat
 * Date: 7/9/15
 * Time: 10:10 AM
 */

namespace DataSourceBundle\Utilities;


class ProfileHelper {

    public static function recommendUpdateProfile(array $profileInfo) {
        //photo
        if( empty($profileInfo['photo']) ) {
            return 'photo';
        }
        //job_title
        if( empty($profileInfo['job_title']) ) {
            return 'job_title';
        }
        //cleaning_json
        if( empty($profileInfo['cleaning_json']) ) {
            return 'cleaning_json';
        }
        //skill_json
        if( empty($profileInfo['skill_json']) ) {
            return 'skill_json';
        }
        //experience_json
        if( empty($profileInfo['experience_json']) ) {
            return 'experience_json';
        }
        //job_history_json
        if( empty($profileInfo['job_history_json']) ) {
            return 'job_history_json';
        }
        //bithday
        if( empty($profileInfo['bithday']) ) {
            return 'bithday';
        }
        //salary_min
        if( empty($profileInfo['salary_min']) ) {
            return 'salary_min';
        }
        //salary_max
        if( empty($profileInfo['salary_max']) ) {
            return 'salary_max';
        }
        //full
        return '';
    }

    public static function getKeyById(array $items, $id) {
        if(empty($items)) {
            return -1;
        }
        foreach( $items as $key => $item) {
            if($item['id'] == $id) {
                return $key;
            }
        }
        return -1;
    }

    public static function resetCurrentJob(array $items) {
        if(empty($items)) {
            return false;
        }
        foreach( $items as $key => $item) {
            $item['current_job'] = 0;
        }
        return $items;
    }

    public static function remove(array &$items, $id) {
        if(empty($items)) {
            return false;
        }
        $rkey = -1;
        foreach( $items as $key => $item) {
            if($item['id'] == $id) {
                $rkey = $key;
                break;
            }
        }
        if($rkey > -1) {
            unset($items[$rkey]);
            return true;
        }
        return false;
    }

    public static function getCompanyFormat() {
        $compay = array(
            'id'  => 123,
            'name'  => 'ABC',
            'title' => 'Developer',
            'start_time' => '11/2013',
            'end_time' => '11/2014',
            'description' => 'description of for ABC',
            'current_job' => false,
            'order' => 1,
            );
        return $compay;
    }

    public static function getEduaFormat() {
        $school = array(
            'id'  => 123,
            'name'  => 'ABC university',
            'start_time' => '2013',
            'end_time' => '2014',
            'major' => 'Computer',
            'order' => 1,
        );
        return $school;
    }

    public static function getSkillFormat() {
        $school = array(
            'id'  => 123,
            'name'  => 'server side php',
            'level' => '1,2,3,4',
            'verified' => 'profileId1,profileId2',
        );
        return $school;
    }

    public static function getSocialNetworkFormat() {
        $school = array(
            'id'  => 123,
            'name'  => 'server side php',
        );
        return $school;
    }

}