<?php

namespace News\NewsBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class ArticleAdminController
 * @package News\NewsBundle\Controller
 * @Route("admin/article")
 */
class ArticleAdminController extends Controller
{
    /**
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('@News/admin/index.html.twig');
    }
}
