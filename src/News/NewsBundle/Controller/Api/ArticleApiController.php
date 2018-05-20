<?php

namespace News\NewsBundle\Controller\Api;

use AppBundle\Exception\ApiException;
use News\NewsBundle\Manager\ArticleManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use UserBundle\Controller\DefaultController;
use UserBundle\Controller\UserController;
use UserBundle\Entity\User;


/**
 * Class ArticleApiController
 * @package News\NewsBundle\Controller\Api
 *
 * @Route("api/article")
 */
class ArticleApiController extends Controller
{
    /**
     * @Route("/" , name="api_article_list")
     * @Method({"GET"})
     */
    public function listHotel(ArticleManager $manager)
    {
        $articlesResponse = [];
        try {
            $articlesResponse = $manager->getList();
        } catch (ApiException $exception) {
            return new JsonResponse($exception->getErrorDetails());
        }

        return new JsonResponse($articlesResponse);
    }
    /**
     * @Route("/user" , name="user_show")
     * @Method({"GET"})
     */
    public function listUs(UserController $manager)
    {
        $articlesResponse = [];
        try {
            $articlesResponse = $manager->getList() ;
        } catch (ApiException $exception) {
            return new JsonResponse($exception->getErrorDetails());
        }

        return new JsonResponse($articlesResponse);
    }
}
