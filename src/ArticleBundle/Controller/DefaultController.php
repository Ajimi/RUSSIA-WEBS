<?php

namespace ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ArticleBundle:Default:index.html.twig');
    }

    public function allAction ()
    {
        $tasks=$this->getDoctrine()->getManager()
            ->getRepository("NewsBundle:Article")
            ->findAll();
        dump($tasks);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formated = $serializer->normalize($tasks);
        return new JsonResponse($formated);


    }
}
