<?php
/**
 * Created by PhpStorm.
 * User: hir0w
 * Date: 2/12/2018
 * Time: 4:55 PM
 */

namespace Reservation\HotelBundle\HotelManager;


use AppBundle\Exception\ApiException;

/**
 * Class Manager
 * @package Reservation\HotelBundle\HotelManager
 */
class Manager
{
    /**
     * @param $entity
     * @param string $message
     * @param int $code
     * @throws ApiException
     */
    public function isEmpty($entity, $message = "A problem Has been occured", $code = 401)
    {
        if (!$entity || empty($entity))
            throw new ApiException($message, $code);
    }
}