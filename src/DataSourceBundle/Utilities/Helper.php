<?php
/**
 * Created by PhpStorm.
 * User: ubuntu
 * Date: 28/06/2015
 * Time: 17:51
 */

namespace DataSourceBundle\Utilities;


class Helper {
    public static function generateRandomString($characters = '23456789abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', $length = 10) {
        //$characters = '23456789abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function randomEmail() {
        $data = array("gmail.com", "yahoo.com", "outlook.com");
        $key = array_rand($data);
        return self::generateRandomString() . "@" . $data[$key];
    }

    public static function randomFirstName() {
        $data = array("Hau", "Cuong", "Binh", "Tam", "Dat", "Long", "Sang", "Tuan", "Khang", "Loc", "Thanh", "Ho");
        $key = array_rand($data);
        return $data[$key];
    }

    public static function randomLastName() {
        $data = array("Nguyan Thanh", "Au chi", "Nguyen huy", "Dao Man", "Le thi", "Da thanh", "Huyen phuoc", "Nguyen anh", "Tran ngoc", "Nguyen thanh", "Nguyen phan nhat", "Tran ba");
        $key = array_rand($data);
        return $data[$key];
    }

    public static function randomJobTitle() {
        $data = array("php developer", "web developer", "senior php developer", "java", "android", "ios", "tester", "designer for web", "designer for game", "frontend developer", "auto tester script", "sysadmin linx");
        $key = array_rand($data);
        return $data[$key];
    }

    public static function randomAddress() {
        return self::generateRandomString() . ", HCM city";
    }

    public static function randomActivity() {
        $data = array("coding php", "coding mysql", "coding paging", "deploy code to server", "google map", "ios map", "checking features web", "designer home pge", "designer character", "coding jquery", "auto tester script", "install env for dev");
        $key = array_rand($data);
        return $data[$key];
    }

    static public function slugify($text) {
        // replace all non letters or digits by -
        $text = preg_replace('/\W+/', '-', $text);
        // trim and lowercase
        $text = strtolower(trim($text, '-'));
        return $text;
    }

}