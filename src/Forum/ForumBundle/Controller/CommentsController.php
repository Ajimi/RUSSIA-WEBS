<?php

namespace Forum\ForumBundle\Controller;


use Doctrine\Common\Persistence\ObjectManager;
use Forum\ForumBundle\Entity\Comment;
use Forum\ForumBundle\Entity\Subject;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use UserBundle\Entity\User;

/**
 * Class CommentsController
 * @package Forum\ForumBundle\Controller
 *
 * @Route("comments")
 */
class CommentsController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/api/new")
     */
    public function newCAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $comment = new Comment();
        $comment->setContent($request->get('content'));
        $comment->setSubject($em->getRepository('ForumBundle:Subject')
            ->find($request->get('id_subject')));
        $em->persist($comment);
        $em->flush();
        $data = $this->serialize($comment);
        return new JsonResponse($data);
    }


    /**
     * @return JsonResponse
     * @Route("/api/all")
     */
    public function allCAction()
    {
        $comments = $this->getDoctrine()->getManager()->getRepository('ForumBundle:Comment')->findAll();
        $data = $this->serializer($comments);
        return new JsonResponse($data);
    }


    /**
     * @return JsonResponse
     * @Route("/find/{idcs}")
     */
    public function findCAction($idcs)
    {
        $em = $this->getDoctrine()->getManager()
            ->getRepository('ForumBundle:Comment')
            ->getCommentsBySubject($idcs);
        $data = $this->serializer($em);
        return new JsonResponse($data);
    }

    public function CountAction()
    {

    }

    /**
     * @param $comments
     * @return array
     */
    public function serializer($comments)
    {
        $data = array();
        foreach ($comments as $comment) {
            $commentData = $this->serialize($comment);
            $data [] = $commentData;
        }
        return $data;
    }

    /**
     * @param Comment $comment
     * @return array
     */
    public function serialize(Comment $comment)
    {
        return array(
            "id" => $comment->getId(),
            "content" => $comment->getContent(),
            "id_subject" => $comment->getSubject()->getId(),
            "created" => $comment->getCreated()->getTimestamp(),
            "updated" => $comment->getUpdated()->getTimestamp(),
        );
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * @param Request $request
     * @Route("/all", name="all_comments")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function allCommentsAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        /** @var Subjects $subject */
        $subject = $request->get('subject');

        $commentsRepo = $em->getRepository('ForumBundle:Comment');
        /** @var Comment[] $comments */
        $comments = $commentsRepo->findBy(['subject' => $subject]);

        return $this->render('@Forum/component/comment-item.html.twig', array('comments' => $comments));
    }

    /**
     * @Route("/{id}",name="comment_add")
     */
    public function addCommentAction(Request $request, Subject $subject = null)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $response = $this->checkExceptions($user, $subject);
        if ($response != true)
            return $response;
        $commentsRepo = $em->getRepository('ForumBundle:Comment');
        $commentsRepo->findBy(['user' => $user, 'subject' => $subject]);

        $comment = new Comment();
        $comment->setContent($request->get('message'));
        $this->commentAdd($em, $subject, $user, $comment);

        return $this->redirectToRoute('subject_show', array('id' => $subject->getId()));

    }



    /**
     * @Route("remove/{subject}/{comment}" , name="remove_comment")
     */
    public function removeCommentAction(Request $request, Subject $subject = null, Comment $comment = null)
    {

        $em = $this->getDoctrine()->getManager();
        /** @var User $user */
        $user = $this->getUser();

        $response = $this->checkExceptions($user, $comment, "Comment not found");
        if ($response != true)
            return $response;


        if (is_null($comment)) {
            // Cannot remove an empty comment
            return $this->getResponse("Cannot remove empty comment");
        } else {

            if ($comment->getUser() == $user) {
                $em->remove($comment);
                $em->flush();
            }
        }
        return $this->redirectToRoute('subject_show', array('id' => $subject->getId()));

    }


    private function commentAdd(ObjectManager $em, Subject $subject, User $user, Comment $subjectComment)
    {

        $subjectComment->setSubject($subject);
        $subjectComment->setUser($user);
        $em->persist($subjectComment);
        $em->flush();
    }


    private function checkExceptions($user, $subject, $message = 'Subject not found')
    {

        if (is_null($user)) {
            return $this->getResponse('You must login');
        }

        if (is_null($subject))
            return $this->getResponse($message);

        return true;

    }


    private function getResponse($message, $messageName = 'error', $result = false, $code = 403)
    {
        return new JsonResponse(array('result' => $result, $messageName => $message));
    }


}