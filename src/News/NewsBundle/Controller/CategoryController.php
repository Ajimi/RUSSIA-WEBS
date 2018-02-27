<?php

namespace News\NewsBundle\Controller;

use function dump;
use News\NewsBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{


    public function categoryAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('NewsBundle:Category');

        /** @var Category[] $categories */
        $categories = $repo->findAll();


        return $this->render('NewsBundle:component:category-list.html.twig', array('categories' => $categories));
    }
}
