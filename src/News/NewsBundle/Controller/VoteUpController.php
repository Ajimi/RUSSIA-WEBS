<?php

namespace News\NewsBundle\Controller;

use Doctrine\Common\Persistence\ObjectManager;
use News\NewsBundle\Entity\Article;
use News\NewsBundle\Entity\VoteUp;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class VoteUpController
 * @Route("vote")
 */
class VoteUpController extends Controller
{

    const VOTE_REMOVE = "remove";
    const VOTE_ADD = "add";

    /**
     * Vote UP for an article
     *
     * @Route("/up/{id}" , name="vote_up" , options={"expose" = true})
     * @param Article $article
     *
     * @return JsonResponse
     */
    public function voteUpAction(Request $request, Article $article = null)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

//        $article = $em->getRepository("NewsBundle:Article")->findOneBy([''])

        if (is_null($user)) {
            return $this->getResponse('You must register');
        }

        if (is_null($article)) {
            return $this->getResponse('Article not found');
        }

        $voteRepo = $em->getRepository('NewsBundle:VoteUp');
        $hasVoted = $voteRepo
            ->findOneBy(['user' => $user, 'article' => $article]);

        if (is_null($hasVoted)) {
            $this->voteAdd($em, $article, $user);
            $votes = $em->getRepository('NewsBundle:VoteUp')->getTotalNumberOfVote($article);
            return new JsonResponse(array('result' => true, 'type' => self::VOTE_ADD, 'total' => $votes, 'vote' => 'Vote successfull'));
        } else {
            // TODO : Vote Remove
            $em->remove($hasVoted);
            $em->flush();
            $votes = $em->getRepository('NewsBundle:VoteUp')->getTotalNumberOfVote($article);
            return new JsonResponse(array('result' => true, 'type' => self::VOTE_REMOVE, 'total' => $votes, 'vote' => 'Vote remove successfull'));
        }
    }

    private function getResponse($message, $messageName = 'error', $result = false, $code = 403)
    {
        return new JsonResponse(array('result' => $result, $messageName => $message));
    }

    private function voteAdd(ObjectManager $em, $article, $user, $vote = VoteUp::VOTE_UP)
    {
        $articleVote = new VoteUp();
        $articleVote->setArticle($article)
            ->setUser($user)
            ->setVoteUp($vote);
        $em->persist($articleVote);
        $em->flush();
    }

    /**
     * @param Request $request
     * @param Article|null $article
     * @return JsonResponse
     * @Route("/check",name="vote_check" , options={"expose" = true})
     */
    public function voteCheckAction(Request $request, Article $article = null)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

//        $article = $em->getRepository("NewsBundle:Article")->findOneBy([''])

        if (is_null($user)) {
            return $this->getResponse(array('result' => false));
        }

        if (is_null($article)) {
            return $this->getResponse(array('result' => false));
        }

        $voteRepo = $em->getRepository('NewsBundle:VoteUp');
        $hasVoted = $voteRepo
            ->findOneBy(['user' => $user, 'article' => $article]);
        if (is_null($hasVoted)) {
            return $this->getResponse(array('result' => false));
        } else {
            return $this->getResponse(array('result' => true));
        }
    }


}