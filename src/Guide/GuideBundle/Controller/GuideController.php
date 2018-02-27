<?php

namespace Guide\GuideBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/guide")
 */
class GuideController extends Controller
{
    /**
     * @Route("/" , name="guide_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('RegionBundle:Region');
        $regions = $repo->findAll();
        return $this->render('GuideBundle:guide:index.html.twig', array('regions' => $regions));
    }

    /**
     * Render FAQ page.
     *
     * @Route("/faq/{page}", name="guide_faq", defaults={"page": "index"})
     *
     * @param Request $request
     * @param string $page
     *
     * @return Response
     * @throws \RuntimeException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function faqAction(Request $request, $page)
    {
        $templateName = basename(sprintf('@Guide/faq/%s.html.twig', $page));
        if ($templateName !== sprintf('%s.html.twig', $page)) {
            throw $this->createNotFoundException('Page not found');
        }
        if (!$this->get('templating')->exists(sprintf('@Guide/faq/%s', $templateName))) {
            throw $this->createNotFoundException(
                sprintf(
                    'Page "%s" not found',
                    $page
                )
            );
        }

        return $this->render(sprintf('@Guide/faq/%s.html.twig', $page));
    }

}
