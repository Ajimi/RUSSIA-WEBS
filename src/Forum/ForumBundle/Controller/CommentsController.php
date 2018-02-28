<?php

namespace Forum\ForumBundle\Controller;

use Doctrine\Common\Persistence\ObjectManager;
use Forum\ForumBundle\Entity\Comment;
use Forum\ForumBundle\Entity\Subject;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

/**
 * Class CommentsController
 * @package Forum\ForumBundle\Controller
 *
 * @Route("comments")
 */
class CommentsController extends Controller
{

    const MAX_COMMENTS = 15;


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
     * @param Request $request
     *
     * @param Subject|null $subject
     * @return JsonResponse
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
        $comments = $commentsRepo->findBy(['user' => $user, 'subject' => $subject]);

        if (count($comments) < self::MAX_COMMENTS) {

            $comment = new Comment();
            $comment->setContent($request->get('message'));
            $this->commentAdd($em, $subject, $user, $comment);

            return $this->redirectToRoute('subject_show', array('id' => $subject->getId()));
        } else {
            return $this->getResponse("You cant't add more than " . self::MAX_COMMENTS, 'response', true, 203);

        }

    }


    /**
     * @param Request $request
     * @param Subject|null $subject
     * @param Comment|null $comment
     *
     * @Route("remove/{subject}/{comment}") , name ="remove_comment")
     * @return JsonResponse
     */
    public function removeCommentAction(Request $request, Subject $subject = null, Comment $comment = null)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $response = $this->checkExceptions($user, $comment, "Comment not found");;
        if ($response)
            return $response;


        $commentsRepo = $em->getRepository('ForumBundle:Comment');
        $comment = $commentsRepo->findOneBy(['id' => $comment]);

        if (is_null($comment)) {
            // Cannot remove an empty comment
            return $this->getResponse("Cannot remove empty comment");
        } else {
            $em->remove($comment);
            $em->flush();
            return $this->getResponse('Removed Perfectly', 'remove', true, 204);
        }

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