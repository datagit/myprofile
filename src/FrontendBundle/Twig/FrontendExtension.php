<?php
namespace FrontendBundle\Twig;
/**
 * Created by PhpStorm.
 * User: dat
 * Date: 7/15/15
 * Time: 4:35 PM
 */

class FrontendExtension extends \Twig_Extension {
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('json_decode', array($this, 'jsonDecodeFilter')),
        );
    }

    public function getFunctions()
    {
        return array(
            'sort_by_order' => new \Twig_Function_Method($this, 'sortByOrderFunc'),
            'get_color_css' => new \Twig_Function_Method($this, 'getColorCssFunc'),
        );
    }

    public function jsonDecodeFilter($json, $isArray = true)
    {
        return json_decode($json, $isArray);
    }

    public function getColorCssFunc($percen) {
        if($percen <= 15) {
            return 'progress-bar-danger';
        }
        if($percen <= 65) {
            return 'progress-bar-warning';
        }
        if($percen <= 80) {
            return 'progress-bar-success';
        }
        return 'progress-bar-info';

    }

    public function sortByOrderFunc($data, $field = 'order') {
        if(empty($data)) {
            return null;
        }
        if($field == 'order') {
            usort($data,
                function ($a, $b) {
                    if(isset($a['order']) && isset($b['order'])) {
                        if ($a['order'] == $b['order']) {
                            return 0;
                        }
                        return ($a['order'] < $b['order']) ? -1 : 1;
                    } else {
                        if ($a == $b) {
                            return 0;
                        }
                        return ($a < $b) ? -1 : 1;
                    }
                }
            );
        } else {
            //level
            usort($data,
                function ($a, $b) {
                    if(isset($a['level']) && isset($b['level'])) {
                        if ($a['level'] == $b['level']) {
                            return 0;
                        }
                        return ($a['level'] < $b['level']) ? 1 : -1;
                    } else {
                        if ($a == $b) {
                            return 0;
                        }
                        return ($a < $b) ? 1 : -1;
                    }
                }
            );
        }

        return $data;
    }
    public function getName()
    {
        return 'frontend_extension';
    }
}