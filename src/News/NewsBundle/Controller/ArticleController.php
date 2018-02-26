<?php

namespace News\NewsBundle\Controller;

use News\NewsBundle\Entity\Article;
use News\NewsBundle\Entity\LikeArticle;
use News\NewsBundle\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Article controller.
 *
 * @Route("article")
 */
class ArticleController extends Controller
{
    /**
     * Lists all article entities.
     *
     * @Route("/", name="article_index")
     * @Method("GET")
     */
    public function articleAction()
    {
        $em = $this->getDoctrine()->getManager();

        /** @var Article[] $spotlights */
        $articles = $em->getRepository('NewsBundle:Article')->findAll();

        return $this->render('NewsBundle:news:index.html.twig', array(
            'articles' => $articles,
        ));
    }

    /**
     * Lists all article entities.
     *
     * @Route("/second", name="article_second")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        /** @var Article[] $spotlights */

        $spotlights = $em->getRepository('NewsBundle:Article')->findSpotLight();

        /** @var Article $most */
        $most = $em->getRepository('NewsBundle:Article')->findLatest();
        /** @var Article $most */
        $rated = $em->getRepository('NewsBundle:Article')->findRated(3);
        return $this->render('NewsBundle:article:home.html.twig', array(
            'spotlights' => $spotlights,

        ));
    }

    /**
     * Finds and displays a article entity.
     *
     * @Route("/{id}", name="article_show")
     * @Method("GET")
     */
    public function showAction(Article $article)
    {

        $em = $this->getDoctrine()->getManager();
        $votes = $em->getRepository('NewsBundle:VoteUp')->getTotalNumberOfVote($article);
        return $this->render('NewsBundle:article:show.html.twig', array(
            'article' => $article,
            'votes' => $votes
        ));
    }


}
