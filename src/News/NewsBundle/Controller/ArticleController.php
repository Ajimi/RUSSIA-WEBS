<?php

namespace News\NewsBundle\Controller;

use Knp\Component\Pager\Pagination\PaginationInterface;
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
    public function articleAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        /** @var Article[] $spotlights */
        $paginator = $this->get('knp_paginator');

        $articlesQuery = $em->getRepository('NewsBundle:Article')->getQueryBuilder();

        if ($request->query->getAlnum('category')) {
            $articlesQuery
                ->where('a.category = :category')
                ->setParameter('category', $request->query->getAlnum('category'));
        }
        /** @var PaginationInterface $articlesPagination */
        $articlesPagination = $paginator->paginate(
            $articlesQuery, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );


        return $this->render('NewsBundle:news:index.html.twig', array(
            'articles' => $articlesPagination,
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/spotlight" , name ="article_spotlight")
     */
    public function spotlightNewsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        /** @var Article[] $spotlights */

        $spotlights = $em->getRepository('NewsBundle:Article')->findSpotLight();

        return $this->render('NewsBundle:article:home.html.twig', array(
            'spotlights' => $spotlights,
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/popular" , name ="article_popular")
     */
    public function popularNewsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        /** @var Article[] $spotlights */

        $spotlights = $em->getRepository('NewsBundle:Article')->findSpotLight();

        return $this->render('NewsBundle:article:home.html.twig', array(
            'spotlights' => $spotlights,
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/latest" , name ="article_latest")
     */
    public function latestNewsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        /** @var Article[] $spotlights */

        $spotlights = $em->getRepository('NewsBundle:Article')->findSpotLight();

        return $this->render('NewsBundle:article:home.html.twig', array(
            'spotlights' => $spotlights,
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
