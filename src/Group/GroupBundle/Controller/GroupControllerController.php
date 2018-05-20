<?php

namespace Group\GroupBundle\Controller;

use Group\GroupBundle\Entity\Groupe;
use Group\GroupBundle\Entity\Rating;
use Group\GroupBundle\Form\GroupeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\UserBundle;

class GroupControllerController extends Controller
{
    /**
     * @Route("AjoutGroup")
     */
    public function AjoutAction(Request $request)
    {
        $group = new group;
        $form = $this->createForm(GroupeType::class, $group);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($group);
            $em->flush();

        }

        return $this->render('GroupBundle:GroupController:ajout.html.twig', array(
            'form' => $form->createView()
            // ...
        ));
    }

    /**
     * @Route("ModifierGroup")
     */
    public function ModifierGroupAction()
    {
        return $this->render('GroupBundle:GroupController:modifierroup.html.twig', array(// ...
        ));
    }

    /**
     * @Route("AfficheGroup")
     */
    public function AfficherGroupAction()
    {
        return $this->render('GroupBundle:GroupController:afficher_group.html.twig', array(// ...
        ));
    }

    /**
     * @Route("DeleteGroup")
     */
    public function DeleteGroupAction()
    {
        return $this->render('GroupBundle:GroupController:delete_group.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/all")
     */
    public function allAction()
    {
        $tasks = $this->getDoctrine()->getManager()->getRepository('GroupBundle:Groupe')->findAll();
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(3);
        $normalizer->setIgnoredAttributes(array("rating", "file"));

        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers);
        $formated = $serializer->normalize($tasks);
        return new JsonResponse($formated);

    }

    /**
     * @Route("/new")
     */

    /* public function newAction(Request $request){
         $em=$this->getDoctrine()->getManager();


         $groups = $this->getDoctrine()->getManager()->getRepository('GroupBundle:Groupe')->findOneBy(['id'=>$request->get('id')]);

         $groups->setRating($request->get('rating'));
         $em->persist($groups);
         $em->flush();
         $serializer = new Serializer([new ObjectNormalizer()]);
         $formated= $serializer->normalize($groups);
         return new JsonResponse($formated);
     }*/


    /*
     * Route(/groupe/new/{id_groupe}/{rate}/{id_user})
     */

    public function addRatingAction($id_groupe, $rate, $id_user)
    {
        $em = $this->getDoctrine()->getManager();
        $reveivedUser = $em->getRepository('UserBundle:User')->find($id_user);
        $reveiveGroupe = $em->getRepository('GroupBundle:Groupe')->find($id_groupe);
        $newRating = new Rating();
        $retrievedRatingResult = $em->getRepository("GroupBundle:Rating")->findOneBy(array('groupId' => $reveiveGroupe, 'userId' => $reveivedUser));
        if ($retrievedRatingResult != null) {
            $retrievedRatingResult->setUserId($reveivedUser);
            $retrievedRatingResult->setGroupId($reveiveGroupe);
            $retrievedRatingResult->setRatingValue($rate);
            $em->persist($retrievedRatingResult);
            $em->flush();
            $reveiveGroupe->setRating($em->getRepository("GroupBundle:Rating")->averageRatingDQL($id_groupe));
            $em->persist($reveiveGroupe);
            $em->flush();
            $normalizer = new ObjectNormalizer();
            $normalizer->setCircularReferenceLimit(3);
            $normalizer->setIgnoredAttributes(array("rating", "file"));

            $normalizers = array($normalizer);
            $serializer = new Serializer($normalizers);
            $formated = $serializer->normalize($retrievedRatingResult);
            return new JsonResponse($formated);


        } else {
            $newRating->setRatingValue($rate);
            $newRating->setUserId($reveivedUser);
            $newRating->setGroupId($reveiveGroupe);
            $em->persist($newRating);
            $em->flush();
            $reveiveGroupe->setRating($em->getRepository("GroupBundle:Rating")->averageRatingDQL($id_groupe));
            $em->persist($reveiveGroupe);
            $em->flush();
            $normalizer = new ObjectNormalizer();
            $normalizer->setCircularReferenceLimit(3);
            $normalizer->setIgnoredAttributes(array("rating", "file"));

            $normalizers = array($normalizer);
            $serializer = new Serializer($normalizers);
            $formated = $serializer->normalize($newRating);
            return new JsonResponse($formated);


        }


    }


}
