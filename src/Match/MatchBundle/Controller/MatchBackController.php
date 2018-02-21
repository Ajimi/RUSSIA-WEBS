<?php

namespace Match\MatchBundle\Controller;

use Match\MatchBundle\Entity\Event;
use Match\MatchBundle\Entity\Match;
use Match\MatchBundle\Entity\Statistics;
use Match\MatchBundle\Form\EventType;
use Match\MatchBundle\Form\MatchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


/**
 * @Route("/admin/match")
 */
class MatchBackController extends Controller
{

    /**
     * @Route("/list", name="match_list")
     */
    public function displayListAction(Request $request)
    {

        $match = new Match();
        $form = $this->createForm(MatchType::class, $match);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $matchs = $em->getRepository("MatchBundle:Match")->findAll();
        return $this->render('MatchBundle:Default:list_match.html.twig', array(
            'matchs' => $matchs,
            'matchForm' => $form->createView(),

        ));

    }

    /**
     * @Route("/add", name="add_match")
     */
    public function addAction(Request $request)
    {

        $match = new Match();
        $form = $this->createForm(MatchType::class, $match);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $match->setDate($request->get('calendar'));
            $match->setTime($request->get('timepicker'));
            $scoreTeam1 = new Statistics($match->getTeam1(), $match, -1, -1, -1, -1, -1);
            $scoreTeam2 = new Statistics($match->getTeam2(), $match, -1, -1, -1, -1, -1);
            $match->setPlayed(false);
            $em->persist($match);
            $em->persist($scoreTeam1);
            $em->persist($scoreTeam2);
            $em->flush();

            return $this->redirectToRoute('match_list');

        }

        return $this->render('MatchBundle:Default:add_match_form.html.twig', [
            'matchForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit_match")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $match = $em->getRepository("MatchBundle:Match")->find($id);
        $Form = $this->createForm(MatchType::class, $match);
        $Form->handleRequest($request);
        if ($Form->isValid()) {
            $em->persist($match);
            $em->flush();
            return $this->redirectToRoute('match_list');
        }

        return $this->render('MatchBundle:Default:edit_match.html.twig',
            array('matchForm' => $Form->createView()));


    }

    /**
     * @Route("/delete/{id}", name="delete_match")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $match = $em->getRepository("MatchBundle:Match")->find($id);
        $score = $em->getRepository('MatchBundle:Statistics')->findBy(array('match' => $match->getId()));
        foreach ($score as $s)
            $em->remove($s);
        $em->remove($match);
        $em->flush();
        return $this->redirectToRoute('match_list');

    }

    /**
     * @Route("/search", name="search_match")
     */

    public function searchAction(Request $request)
    {


        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            //$val = $request ->get('search')->getData();
            $val = "se";
            alert($val);
            $em = $this->getDoctrine()->getManager();
            $repo = $em->getRepository('MatchBundle:Match');
            $match = $repo->searchDQL($val);

            $s = new Serializer(array(new ObjectNormalizer()));
            $data = $s->normalize($match);
            return new JsonResponse($data);

        }

    }

}
