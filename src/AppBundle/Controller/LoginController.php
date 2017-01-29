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
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use AppBundle\Entity\Utilisateur;
use AppBundle\Entity\Publication;
use AppBundle\Entity\Notification;
use AppBundle\Entity\Commentaire;
use AppBundle\Entity\Entite;

class LoginController extends Controller
{

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $utilisateur = new Utilisateur();
        $utilisateurInscription = new Utilisateur();

        $formInscription = $this->createFormBuilder($utilisateurInscription)
            ->add('prenomUtilisateur', TextType::class, 
                array('attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Votre Prenom', 
                    'style' => 'margin-bottom : 15px')))
            ->add('origineUtilisateur', TextType::class, 
                array('attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Votre Nom', 
                    'style' => 'margin-bottom : 15px')))
            ->add('emailUtilisateur', EmailType::class, 
                array('attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Votre Adresse Mail', 
                    'style' => 'margin-bottom : 15px')))
            ->add('passwordUtilisateur', PasswordType::class, array('attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Mot de passe', 
                    'style' => 'margin-bottom : 15px')))
            ->add('Inscription', SubmitType::class, 
                array('attr' => array('class' => 'btn btn-azure'), 'label' => 'S\'inscrire'))
            ->getForm();

        $form = $this->createFormBuilder($utilisateur)
            ->add('emailUtilisateur', EmailType::class, 
                array('attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Adresse mail', 
                    'style' => 'margin-bottom : 15px')))
            ->add('passwordUtilisateur', PasswordType::class, array('attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Mot de passe', 
                    'style' => 'margin-bottom : 15px')))
            ->add('Connexion', SubmitType::class, 
                array('attr' => array('class' => 'btn btn-azure'), 'label' => 'Connexion'))
            ->getForm();


        // LOGIN
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $utilisateur = $form->getData();


            $user = $this->getDoctrine()
                ->getRepository('AppBundle:Utilisateur')
                ->findOneBy(array(
                    'emailUtilisateur'=>$utilisateur->emailUtilisateur, 
                    'passwordUtilisateur'=>$utilisateur->passwordUtilisateur));

            if (!$user) {
                return $this->redirectToRoute('login', array(
                    'erreur' => 'login password incorrect',
                ));
            }else{
                $entite = $this->getDoctrine()
                ->getRepository('AppBundle:Entite')
                ->findOneBy(array(
                    'idEntite'=>$user->getEntiteUtilisateur()));

                // insertion information utilisateur connecté en session
                $session = new Session();
                $session->set('utilisateur', $user);
                $session->set('entite', $entite);

                return $this->redirectToRoute('home');
            }
        }


        // INSCRIPTION
        $formInscription->handleRequest($request);


        if ($formInscription->isSubmitted() && $formInscription->isValid()) {

            $utilisateurInscription = $formInscription->getData();

            $entite = new Entite();
            $entite->setNomEntite($utilisateurInscription->getOrigineUtilisateur());
            $entite->setPhotoEntite('default.png');
            $entite->setPhotoJournalEntite('default.jpg');
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($entite);
            $em->flush();

            
            $utilisateurInscription->setOrigineUtilisateur(null);
            $utilisateurInscription->setEntiteUtilisateur($entite);

            $req_insert_utilisateur = 
            "INSERT INTO `utilisateur` (`email_utilisateur`, `prenom_utilisateur`, `password_utilisateur`, `date_naissance_utilisateur`, `origine_utilisateur`, `entite_utilisateur`, `sexe`) VALUES ('".$utilisateurInscription->getEmailUtilisateur()."', '".$utilisateurInscription->getPrenomUtilisateur()."', '".$utilisateurInscription->getPasswordUtilisateur()."', NULL, NULL, '".$entite->getIdEntite()."', 'Homme');";

            $em = $this->getDoctrine()->getManager();
            $connection = $em->getConnection();
            $statement = $connection->prepare($req_insert_utilisateur);
            $statement->execute();

            // insertion information utilisateur connecté en session
            $session = new Session();
            $session->set('utilisateur', $utilisateurInscription);
            $session->set('entite', $entite);

            return $this->redirectToRoute('home');
        }



        return $this->render('bassem/login.html.twig', array(
            'form' => $form->createView(),
            'formInscription' => $formInscription->createView(),
        ));
    }
}