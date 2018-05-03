<?php

namespace Forum\ForumBundle\Controller;

use Forum\ForumBundle\Entity\Subject;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SubjectApiController
 * @package Forum\ForumBundle\Controller
 * @Route("api/subjects")
 */
class SubjectApiController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/all")
     */
    public function allAction()
    {
        $subjects = $this->getDoctrine()->getManager()->getRepository('ForumBundle:Subject')->findAll();
        $data = $this->serializer($subjects);
        return new JsonResponse($data);
    }

    /**
     * @param Subject[] $subjects
     * @return array
     */
    public function serializer($subjects)
    {
        $data = array();
        foreach ($subjects as $subject) {
            $subjectData = $this->serialize($subject);
            $data [] = $subjectData;
        }
        return $data;
    }

    /**
     * @param Subject $subject
     * @return array
     * @internal param $subjects
     */
    public function serialize(Subject $subject)
    {
        return array(
            "id" => $subject->getId(),
            "title" => $subject->getTitle(),
            "content" => $subject->getContent(),
            "filename" => $subject->getFilename(),
            "etat" => $subject->getEtat(),
            "created" => $subject->getCreated()->getTimestamp(),
            "updated" => $subject->getUpdated()->getTimestamp(),
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/new")
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $subject = new Subject();
        $subject->setTitle($request->get('title'));
        $subject->setContent($request->get('content'));
        $subject->setFilename($request->get('filename'));
        $subject->setEtat($request->get('etat'));
        $em->persist($subject);
        $em->flush();
        $data = $this->serialize($subject);
        return new JsonResponse($data);
    }

    /**
     * @param Subject $subject
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/{id}")
     */
    public function findAction(Subject $subject)
    {
        $data = $this->serialize($subject);

        return new JsonResponse($data);
    }

    /**
     * @param $title
     * @return JsonResponse
     * @\Symfony\Component\Routing\Annotation\Route("/findTitle/{title}")
     */
    public function findTitleAction($title)
    {
        $em = $this->getDoctrine()->getManager()
            ->getRepository('ForumBundle:Subject')
            ->getTitleSubject($title);
        $data = $this->serializer($em);
        return new JsonResponse($data);
    }

}
