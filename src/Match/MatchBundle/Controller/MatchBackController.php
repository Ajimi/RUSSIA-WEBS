<?php

namespace Match\MatchBundle\Controller;

use Match\MatchBundle\Entity\Match;
use Match\MatchBundle\Form\MatchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/admin/match")
 */
class MatchBackController extends Controller
{

    /**
     * @Route("/list", name="match_list")
     */
    public function displayListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $matchs = $em->getRepository("MatchBundle:Match")->findAll();

        return $this->render('MatchBundle:Default:list_match.html.twig', array(
            'matchs' => $matchs
        ));
    }
    /**
     * @Route("/index", name="match_index")
     */
    public function indexAction(Request $request)
    {
        $match = new Match();
        $form = $this->createForm(MatchType::class, $match);
        $form->handleRequest($request);
        if ($form->isValid() & $form->isSubmitted()) {
            dump($form->getData());

            dump($match);
            $em = $this->getDoctrine()->getManager();
            $match->setDate($request->get('calendar'));
            $match->setTime($request->get('timepicker'));

            dump($match);

            $em->persist($match);
            $em->flush();
            return $this->redirectToRoute('match_index');

        }

        return $this->render('MatchBundle:Default:index.html.twig', [
            'matchForm' => $form->createView()
        ]);

    }

    /**
     * @Route("/add", name="add_match")
     */
    public function addAction(Request $request)
    {

        $match = new Match();
        $form = $this->createForm(MatchType::class, $match);
        $form->handleRequest($request);
        if ($form->isValid() & $form->isSubmitted()) {
            dump($form->getData());

            dump($match);
            $em = $this->getDoctrine()->getManager();
            $match->setDate($request->get('calendar'));
            $match->setTime($request->get('timepicker'));

            dump($match);

            $em->persist($match);
            $em->flush();
            return $this->redirectToRoute('match_index');

        }

        return $this->render('MatchBundle:Default:index.html.twig', [
            'matchForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete_match")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $match = $em->getRepository("MatchBundle:Match")->find($id);
        $em->remove($match);
        $em->flush();
        return $this->redirectToRoute('match_list');

    }

    /**
     * @Route("/test", name="match_test")
     */
    public function testTwigAction()
    {
        $form = $this->createForm(MatchType::class);
        return $this->render('MatchBundle:Default:test.html.twig');

    }
}
