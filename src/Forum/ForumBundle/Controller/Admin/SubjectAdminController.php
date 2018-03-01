<?php

namespace Forum\ForumBundle\Controller\Admin;

use Forum\ForumBundle\Entity\Comment;
use Forum\ForumBundle\Entity\Subject;
use Forum\ForumBundle\Form\SubjectType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Subject controller.
 *
 * @Route("/admin/subject")
 */
class SubjectAdminController extends Controller
{
    /**
     * Lists all subject entities.
     *
     * @Route("/", name="admin_subject_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $subjects = $em->getRepository('ForumBundle:Subject')->findAll();

        return $this->render('ForumBundle:admin/subject:index.html.twig', array(
            'subjects' => $subjects,

        ));
    }

    /**
     * Creates a new subject entity.
     *
     * @Route("/new", name="admin_subject_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $subject = new Subject();
        $form = $this->createForm(SubjectType::class, $subject);
        $form->handleRequest($request);
        $user = $this->getUser();
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $subject->setEtat('Accept');
            $subject->setAuther($user);
            $em->persist($subject);
            $em->flush();
            dump($subject);
            return $this->redirectToRoute('admin_subject_show', array('id' => $subject->getId()));
        }

        return $this->render('ForumBundle:admin/subject:new.html.twig', array(
            'subject' => $subject,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a subject entity.
     *
     * @Route("/{id}", name="admin_subject_show")
     * @Method("GET")
     */
    public function showAction(Subject $subject)
    {
        $deleteForm = $this->createDeleteForm($subject);
        $comments = new Comment();
        return $this->render('ForumBundle:admin/subject:show.html.twig', array(
            'subject' => $subject,
            'delete_form' => $deleteForm->createView(),
            'comments' => $comments
        ));
    }

    /**
     * Displays a form to edit an existing subject entity.
     *
     * @Route("/{id}/edit", name="admin_subject_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Subject $subject)
    {
        $deleteForm = $this->createDeleteForm($subject);
        $editForm = $this->createForm('Forum\ForumBundle\Form\SubjectType', $subject);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {


            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_subject_show', array('id' => $subject->getId()));
        }

        return $this->render('ForumBundle:admin/subject:edit.html.twig', array(
            'subject' => $subject,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a subject entity.
     *
     * @Route("/{id}", name="admin_subject_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Subject $subject)
    {
        $form = $this->createDeleteForm($subject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($subject);
            $em->flush();
        }

        return $this->redirectToRoute('admin_subject_index');
    }

    /**
     * Creates a form to delete a subject entity.
     *
     * @param Subject $subject The subject entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Subject $subject)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_subject_delete', array('id' => $subject->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * @param Request $request
     * @param Subject $subject
     * @Route("/accept/{id}", name="accept_subject")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function acceptSubjectAction(Request $request, Subject $subject)
    {
        $em= $this->getDoctrine()->getManager();
        $subject->setEtat('Accept');
        $em->persist($subject);
        $em->flush();
        return $this->redirectToRoute('admin_subject_index');
    }

    /**
     * @param Request $request
     * @param Subject $subject
     * @Route("/refus/{id}",name="refuse_subject")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function refuseSubjectAction(Request $request, Subject $subject)
    {
        $em= $this->getDoctrine()->getManager();
        $subject->setEtat('Refuse');
        $em->persist($subject);
        $em->flush();
        return $this->redirectToRoute('admin_subject_index');
    }
}
