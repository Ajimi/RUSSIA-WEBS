<?php

namespace News\NewsBundle\Controller;

use News\NewsBundle\Entity\Category;
use News\NewsBundle\Form\CategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CategoryAdminController
 * @package News\NewsBundle\Controller
 * @Route("admin/category")
 */
class CategoryAdminController extends Controller
{

    /**
     * Lists all category entities.
     *
     * @Route("/", name="admin_category_index")
     * @Method("GET")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        /** @var Category[] $categories */
        $categories = $em->getRepository('NewsBundle:Category')->findAll();

        return $this->render('NewsBundle:category:index.html.twig', array(
            'categories' => $categories,
        ));

    }

    /**
     * Creates a new category entity.
     *
     * @Route("/new", name="admin_category_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm('News\NewsBundle\Form\CategoryType', $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('admin_category_index', array('id' => $category->getId()));
        }

        return $this->render('NewsBundle:category:new.html.twig', array(
            'category' => $category,
            'form' => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing category entity.
     *
     * @Route("/{id}/edit", name="admin_category_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Category $category)
    {
        $editForm = $this->createForm(CategoryType::class, $category);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('admin_category_index');
        }

        return $this->render('NewsBundle:category:edit.html.twig', array(
            'category' => $category,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a category entity.
     *
     * @Route("/{id}/delete", name="admin_category_delete")
     */
    public function deleteAction(Request $request, Category $category)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();

        return $this->redirectToRoute('admin_category_index');
    }

}
