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

class AmisController extends Controller
{
	/**
     * @Route("/ajouter_amis/{email_utilisateur}/", name="ajouter_amis")
     */
    public function ajouterAmisAction(Request $request)
    {
        // charger la session
        $session = $request->getSession();

        // redirection de l'utilisateur vers page login en cas ou il n'est pas connecté
        if(!$session->get('utilisateur')){
            return $this->redirectToRoute('login');
        }

        try{
            $email_utilisateur = $request->attributes->get('email_utilisateur');

            $req_ajouter_amis ="INSERT INTO `liste_attente` (`id_demandeur_liste_attente`, `id_recepteur_liste_attente`) VALUES ('".$session->get('utilisateur')->getEmailUtilisateur()."', '".$email_utilisateur."');";
            
            $em = $this->getDoctrine()->getManager();
            $connection = $em->getConnection();
            $statement = $connection->prepare($req_ajouter_amis);
            $statement->execute();

            // AJOUTER DANS LA TABLE NOTIFICATION 
            $req_ajouter_amis ="INSERT INTO `notification` (id_publication_notification,`acteur_notification`, `date_notification`, `type_notification`) VALUES ('".$email_utilisateur."' ,'".$session->get('utilisateur')->getEmailUtilisateur()."', CURRENT_TIMESTAMP, 'envoyer une invitation');";
            
            $em = $this->getDoctrine()->getManager();
            $connection = $em->getConnection();
            $statement = $connection->prepare($req_ajouter_amis);
            $statement->execute();
        } catch(\Exception $e){}

        return $this->redirect('/user/'.$email_utilisateur);
    }

    /**
     * @Route("/accepter_amis/{email_utilisateur}/", name="accepter_amis")
     */
    public function accepterAmisAction(Request $request)
    {
        // charger la session
        $session = $request->getSession();

        // redirection de l'utilisateur vers page login en cas ou il n'est pas connecté
        if(!$session->get('utilisateur')){
            return $this->redirectToRoute('login');
        }

        $email_utilisateur = $request->attributes->get('email_utilisateur');


        try{
            // SUPPRIMER CET AMIS DE LA LISTE D'ATTENTE
            $req_accepter_amis ="DELETE FROM `liste_attente` WHERE (`liste_attente`.`id_demandeur_liste_attente` = '".$session->get('utilisateur')->getEmailUtilisateur()."' AND `liste_attente`.`id_recepteur_liste_attente` = '".$email_utilisateur."') OR (`liste_attente`.`id_demandeur_liste_attente` = '".$email_utilisateur."' AND `liste_attente`.`id_recepteur_liste_attente` = '".$session->get('utilisateur')->getEmailUtilisateur()."')";

            $em = $this->getDoctrine()->getManager();
            $connection = $em->getConnection();
            $statement = $connection->prepare($req_accepter_amis);
            $statement->execute();
        } catch(\Exception $e){}

        try{
            // AJOUTER UTILISATEUR DANS TABLE list_amis
            $req_accepter_amis ="INSERT INTO `liste_amis` (`id_utilisateur_liste_amis`, `id_ami_liste_amis`) VALUES ('".$session->get('utilisateur')->getEmailUtilisateur()."', '".$email_utilisateur."');";

            $em = $this->getDoctrine()->getManager();
            $connection = $em->getConnection();
            $statement = $connection->prepare($req_accepter_amis);
            $statement->execute();
        } catch(\Exception $e){}

            // AJOUTER DANS LA TABLE NOTIFICATION 
            $req_ajouter_amis ="INSERT INTO `notification` (id_publication_notification,`acteur_notification`, `date_notification`, `type_notification`) VALUES ('".$email_utilisateur."' ,'".$session->get('utilisateur')->getEmailUtilisateur()."', CURRENT_TIMESTAMP, 'accepter votre invitation')";
            
            $em = $this->getDoctrine()->getManager();
            $connection = $em->getConnection();
            $statement = $connection->prepare($req_ajouter_amis);
            $statement->execute();
        

        return $this->redirect('/user/'.$email_utilisateur);
    }

    /**
     * @Route("/ne_pas_accepter_amis/{email_utilisateur}/", name="ne_pas_accepter_amis")
     */
    public function ne_pas_accepterAmisAction(Request $request)
    {
        // charger la session
        $session = $request->getSession();

        // redirection de l'utilisateur vers page login en cas ou il n'est pas connecté
        if(!$session->get('utilisateur')){
            return $this->redirectToRoute('login');
        }

        $email_utilisateur = $request->attributes->get('email_utilisateur');


        // SUPPRIMER CET AMIS DE LA LISTE D'ATTENTE
        $req_accepter_amis ="DELETE FROM `liste_attente` WHERE (`liste_attente`.`id_demandeur_liste_attente` = '".$session->get('utilisateur')->getEmailUtilisateur()."' AND `liste_attente`.`id_recepteur_liste_attente` = '".$email_utilisateur."') OR (`liste_attente`.`id_demandeur_liste_attente` = '".$email_utilisateur."' AND `liste_attente`.`id_recepteur_liste_attente` = '".$session->get('utilisateur')->getEmailUtilisateur()."')";

        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare($req_accepter_amis);
        $statement->execute();

        return $this->redirect('/user/'.$email_utilisateur);
    }

    
    /**
     * @Route("/supprimer_amis/{email_utilisateur}/", name="supprimer_amis")
     */
    public function supprimerAmisAction(Request $request)
    {
        // charger la session
        $session = $request->getSession();

        // redirection de l'utilisateur vers page login en cas ou il n'est pas connecté
        if(!$session->get('utilisateur')){
            return $this->redirectToRoute('login');
        }

        $email_utilisateur = $request->attributes->get('email_utilisateur');

        // SUPPRIMER UTILISATEUR DE LA LISTE DES AMIS
        $req_supprimer_amis ="DELETE FROM `liste_amis` WHERE (`liste_amis`.`id_utilisateur_liste_amis` = '".$session->get('utilisateur')->getEmailUtilisateur()."' AND `liste_amis`.`id_ami_liste_amis` = '".$email_utilisateur."') OR (`liste_amis`.`id_utilisateur_liste_amis` = '".$email_utilisateur."' AND `liste_amis`.`id_ami_liste_amis` = '".$session->get('utilisateur')->getEmailUtilisateur()."')";
        
        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare($req_supprimer_amis);
        $statement->execute();

        return $this->redirect('/user/'.$email_utilisateur);
    }

	/**
     * @Route("/amis/{email_utilisateur}/", name="amis")
     */
    public function listAmisAction(Request $request)
    {
        // charger la session
        $session = $request->getSession();

        // redirection de l'utilisateur vers page login en cas ou il n'est pas connecté
        if(!$session->get('utilisateur')){
            return $this->redirectToRoute('login');
        }

        $email_utilisateur = $request->attributes->get('email_utilisateur');

        // SUPPRIMER UTILISATEUR DE LA LISTE DES AMIS
        $req_list_amis =
        "SELECT * ".
        "FROM utilisateur,entite ".
        "WHERE utilisateur.entite_utilisateur = entite.id_entite AND utilisateur.email_utilisateur IN ".
            "(SELECT `id_utilisateur_liste_amis` ".
                "FROM `liste_amis` ".
                "WHERE `id_ami_liste_amis`= '".$email_utilisateur."' ".
            "UNION ".
                "SELECT `id_ami_liste_amis` ".
                "FROM `liste_amis` ".
                "WHERE `id_utilisateur_liste_amis`= '".$email_utilisateur."')";
        
        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare($req_list_amis);
        $statement->execute();
        $list_amis = $statement->fetchAll();


        return $this->render('bassem/list_amis.html.twig', array(
                'list_amis' => $list_amis,
                )
            );
    }


}