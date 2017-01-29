<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Entity\Utilisateur;
use AppBundle\Entity\Publication;
use AppBundle\Entity\Notification;
use AppBundle\Entity\Commentaire;
use AppBundle\Entity\Entite;

class NotificationController extends Controller
{

    /**
     * @Route("/remove_notification/{id}", name="image")
     */
    public function removeNotificationAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $id = $request->attributes->get('id');

        $notification = $this->getDoctrine()
        ->getRepository('AppBundle:Notification')
        ->findOneBy(array('idNotificationNotification' => $id));

        if (!$notification) {
            die("echec");
        }

        if($notification->getEtatNotification() == 1){
            $notification->setEtatNotification(0);
        }else{
            $notification->setEtatNotification(1);
        }
        $em->flush();
        

        die("success ".$notification->getEtatNotification());

        //return $this->render('bassem/image.html.twig');
    }
}