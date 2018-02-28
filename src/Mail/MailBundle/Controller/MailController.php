<?php
/**
 * Created by PhpStorm.
 * User: Malak
 * Date: 28/02/2018
 * Time: 01:19
 */

namespace Mail\MailBundle\Controller;

use Mail\MailBundle\Entity\Mail;
use Mail\MailBundle\Form\MailType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swift_Mailer;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Swift_Message;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/mail")
 */
class MailController extends Controller
{
    /**
     * @Route("/pagemail" )
     */
    public function indexAction(Request $request, Swift_Mailer $mailer)
    {
//        $mail = new Mail();
//        $form = $this->createForm(MailType::class, $mail);
//        $form->handleRequest($request);

        $form = $this->createFormBuilder()
            ->add('from', EmailType::class)
            ->add('message', TextareaType::class)
            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            dump($data);
            $message = (new \Swift_Message('Hello Email'))
                ->setSubject('Accusé de réception')
//                ->setFrom($this->getParameter('mailer_user'))
                ->setFrom($data['from'])
                ->setTo('russia2018coupedumonde@gmail.com')
                ->setBody(
                    $form->getData()['message'],
                    'text/html'
                );
//                ->setTo($mail->getEmail())
//                ->setBody(
//                    $this->renderView('@MailMail/Default/email.html.twig', array(
//                        'nom' => $mail->getNom(), 'prenom' => $mail->getPrenom())),
//                    'text/html');
            $mailer->send($message);
//           return $this->redirectToRoute('mail_success',array(
//               'mail'=>$mail->getEmail(),
//           ));
        }
        return $this->render('@MailMail/Default/index.html.twig',
            array('form' => $form->createView()));
    }
    /**
     * @Route("/successmail/{mail}" ,name="mail_success")
     */
    public function successAction($mail)
    {
        return new Response("email envoyé avec succès, Merci de vérifier votre boite mail.".$mail);
    }

}