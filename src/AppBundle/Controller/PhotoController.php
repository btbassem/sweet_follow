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

class PhotoController extends Controller
{
	/**
     * @Route("/photo/{email_utilisateur}/", name="photo")
     */
    public function photoAction(Request $request)
    {
        // charger la session
        $session = $request->getSession();

        // redirection de l'utilisateur vers page login en cas ou il n'est pas connecté
        if(!$session->get('utilisateur')){
            return $this->redirectToRoute('login');
        }

        return $this->render('bassem/photos1.html.twig');
    }
}