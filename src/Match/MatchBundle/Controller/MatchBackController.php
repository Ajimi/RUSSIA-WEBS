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
     * @Route("/index", name="match_index")
     */
    public function indexAction()
    {
        return $this->render('MatchBundle:Default:index.html.twig');
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
            // return $this->redirectToRoute('_afficheV');
        }

        return $this->render('MatchBundle:Default:add_match_form.html.twig', [
            'matchForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/test", name="match_test")
     */
    public function testTwigAction()
    {
        $form = $this->createForm(MatchType::class);
        return $this->render('MatchBundle:Default:test.html.twig',[
            'matchForm'=>$form->createView()
        ]);

    }
}
