<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use UserBundle\Entity\User;

class UserController extends Controller
{
    /**
     * @Route("/user/u", name="schedule_api")
     */
    public function jsonScheduleAction()
    {
        $em = $this->getDoctrine()->getManager();
        $matchs = $em->getRepository("UserBundle:User")->findAll();
        $formatedMatchs = [] ;
        foreach ($matchs as $match){
            $formatedMatchs [] = $this->parseUser($match);
        }
        return new JsonResponse($formatedMatchs);
    }


    private function parseUser(User $u){
        return array(
            "id"=>$u->getId(),
            "username"=>$u->getUsername(),
            "email"=>$u->getEmail(),
            "password" => $u->getPassword(),
            "roles" => $u->getRoles()
        );
    }

    /**
     * @Route("/user/u/{username}/{pass}", name="schedule_api")
     */
    public function jsonScheduleUCAction($username,$pass)
    {
        $em = $this->getDoctrine()->getManager();
        $matchs = $em->getRepository("UserBundle:User")->findby(['username'=>$username,'password'=>$pass]);
        $formatedMatchs = [] ;
        foreach ($matchs as $match){
            $formatedMatchs [] = $this->parseUser($match);
        }
        return new JsonResponse($formatedMatchs);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("api/user/{username}/{email}/{password}/{roles}")
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = new user();
        $username=$request->get('username');
        $email=$request->get('email');
        $user->setUsername($username);
        $user->setUsernameCanonical($username);
        $user->setEmail($email);
        $user->setEmailCanonical($email);
        $user->setPassword($request->get('password'));
        $user->setEnabled(1);
        $user->setRoles(array ($request->get('roles')));// khadamha chneya donc xD
        $em->persist($user);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]); // marwen walleh me5demeteha 3la json lahdha nchouf
        $formatted = $serializer->normalize($user);
        return new JsonResponse($formatted);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("api/modir/{username}/{email}/{password}/{id}")
     */
    public function modif2Action(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('UserBundle:User')->find($id);


        $user-> setUsername($request->get('username'));

        $user-> setPassword($request->get('password'));
        $user-> setEmail($request->get('email'));





        // ... persist the $product variable or any other work
        $em->persist($user);
        $em->flush();


        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($user);
        return new JsonResponse($formatted);




    }

}
