<?php
/**
 * Created by PhpStorm.
 * User: zouaghi
 * Date: 26/04/2018
 * Time: 22:43
 */

namespace News\NewsBundle\Controller\Api;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/apis")
 */
class ApiController extends Controller
{
    /**
     * @Route("/article", name="api_article")
     */
    public function allAction ()
    {
        $tasks=$this->getDoctrine()->getManager()
            ->getRepository("NewsBundle:Article")
            ->findAll();
        dump($tasks);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formated = $serializer->normalize($tasks);
        return new JsonResponse($formated);


    }
}