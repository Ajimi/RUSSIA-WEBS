<?php

namespace News\NewsBundle\Controller\Admin;

use News\NewsBundle\Entity\Article;
use News\NewsBundle\Form\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ArticleAdminController
 * @package News\NewsBundle\Controller
 * @Route("admin/article")
 */
class ArticleAdminController extends Controller
{
    /**
     * Lists all article entities.
     *
     * @Route("/", name="admin_article_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('NewsBundle:Article')->findAll();

        return $this->render('NewsBundle:admin:index.html.twig', array(
            'articles' => $articles,
        ));
    }

    /**
     * Creates a new article entity.
     *
     * @Route("/new", name="admin_article_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $article = new Article();
        $form = $this->createForm('News\NewsBundle\Form\ArticleType', $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('admin_article_index', array('id' => $article->getId()));
        }

        return $this->render('NewsBundle:admin:new.html.twig', array(
            'article' => $article,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a article entity.
     *
     * @Route("/{id}", name="admin_article_show")
     * @Method("GET")
     */
    public function showAction(Article $article)
    {

        return $this->render('NewsBundle:admin:show.html.twig', array(
            'article' => $article,
        ));
    }

    /**
     * Displays a form to edit an existing article entity.
     *
     * @Route("/{id}/edit", name="admin_article_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Article $article)
    {
        $editForm = $this->createForm(ArticleType::class, $article);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('admin_article_index');
        }

        return $this->render('NewsBundle:admin:edit.html.twig', array(
            'article' => $article,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a article entity.
     *
     * @Route("/{id}/delete", name="admin_article_delete")
     */
    public function deleteAction(Request $request, Article $article)
    {

            $em = $this->getDoctrine()->getManager();
            $em->remove($article);
            $em->flush();

        return $this->redirectToRoute('admin_article_index');
    }
}
