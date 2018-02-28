<?php
/**
 * Created by PhpStorm.
 * User: Malak
 * Date: 27/02/2018
 * Time: 21:23
 */

namespace Forum\ForumBundle\Controller;


use Forum\ForumBundle\Entity\Subject;
use Forum\ForumBundle\Form\SubjectTypeUser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Subject controller.
 *
 * @Route("subjects")
 */
class SubjectsController extends Controller
{
    /**
     * Lists all subject entities.
     *
     * @Route("/", name="subjects_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $subjects = $em->getRepository('ForumBundle:Subject')->findAll();

        return $this->render('ForumBundle:subject:index.html.twig', array(
            'subjects' => $subjects,
        ));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/new",name="subject_add")
     */
    public function addSubjectAction(Request $request)
    {
        $subject = new Subject();
        $form = $this->createForm(SubjectTypeUser::class, $subject);
        $form->handleRequest($request);
        $user = $this->getUser();
        dump($user);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $subject->setEtat('Waiting');
            $subject->setAuther($this->getUser());
            $em->persist($subject);
            $em->flush();
            dump($subject);
            return $this->redirectToRoute('subject_index', array());
        }

        return $this->render('ForumBundle:subject:new.html.twig', array(
            'subject' => $subject,
            'form' => $form->createView(),
        ));
    }


    private function getResponse($message, $messageName = 'error', $result = false, $code = 403)
    {
        return new JsonResponse(array('result' => $result, $messageName => $message));
    }
}