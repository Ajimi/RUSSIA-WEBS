<?php
/**
 * Created by PhpStorm.
 * User: Malak
 * Date: 10/02/2018
 * Time: 16:57
 */

namespace Forum\ForumBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/forum")
 */
class ForumController extends Controller
{
    /**
     * @Route("/list" , name="forum_list")
     */
    public function ListAction()
    {
        return $this->render("ForumBundle:Forum:List.html.twig",array());
    }

}