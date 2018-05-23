<?php
/**
 * Created by PhpStorm.
 * User: KaYdaz
 * Date: 30/04/2018
 * Time: 11:22
 */

namespace Player\PlayerBundle\Util;


use Player\PlayerBundle\Entity\Club;
use Player\PlayerBundle\Entity\View;

class ViewApiController
{

    /**
     * @param $views
     * @return array
     * @internal param $
     */
    public static function serializer($views)
    {
        $data = array();
        foreach ($views as $view) {
            $viewData = ViewApiController::serialize($view);
            $data[] = $viewData;
        }
        return $data;
    }

    /**
     * @param View $view
     * @return array
     * @internal param $clubs
     */
    public static function serialize(View $view)
    {
        return array(
            "id" => $view->getId(),
            "user" => $view->getUser()->getUsername(),
            "post" => $view->getPost(),
        );
    }
}