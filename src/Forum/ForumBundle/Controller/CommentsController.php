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
     * @param Request $request
     * @param Subject|null $subject
     * @param Comment|null $comment
     *
     * @Route("remove/{subject}/{comment}" , name="selim_ajimi")
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