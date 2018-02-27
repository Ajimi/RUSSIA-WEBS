<?php
/**
 * Created by PhpStorm.
 * User: zouaghi
 * Date: 27/02/2018
 * Time: 16:28
 */

namespace News\NewsBundle\Controller;


use News\NewsBundle\Entity\Article;
use News\NewsBundle\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ArticleComponentController extends Controller
{

    public function footerArticlesAction(Request $request)
    {

        $repo = $this->getRepository();

        /** @var Article[] $popularArticles */
        $popularArticles = $repo->getPopularArticles(4);

        return $this->render('@News/component/footer-popular.html.twig', array('articles' => $popularArticles));
    }

    private function getRepository()
    {
        return $this->getDoctrine()->getManager()->getRepository('NewsBundle:Article');
    }

    public function latestNewsCarouselAction(Request $request)
    {
        /** @var ArticleRepository $repo */
        $repo = $this->getRepository();

        /** @var Article[] $latestNewsArticles */
        $latestNewsArticles = $repo->findLatest(3);
        dump($latestNewsArticles);
        return $this->render('@News/component/latest-news-carousel.html.twig', array('articles' => $latestNewsArticles));

    }

    public function spotLightAsideAction(Request $request)
    {
        /** @var ArticleRepository $repo */
        $repo = $this->getRepository();

        /** @var Article[] $spotlightArticles */
        $spotlightArticles = $repo->findSpotLight(4);
        return $this->render('@News/component/spotlight-aside.html.twig', array('articles' => $spotlightArticles));

    }

    public function headerNewsAction(Request $request)
    {
        $repo = $this->getRepository();

        $articles = $repo->findSpotLight(4);
        return $this->render('@News/component/header-news.html.twig', array('articles' => $articles));
    }
}