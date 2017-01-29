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

class MessageController extends Controller
{
	
    /**
     * @Route("/messages/{id_user}", name="chat")
     */
    public function messageAction(Request $request)
    {
        
        // charger la session
        $session = $request->getSession();

        // redirection de l'utilisateur vers page login en cas ou il n'est pas connecté
        if(!$session->get('utilisateur')){
            return $this->redirectToRoute('login');
        }

        // l'utilisateur est connecté 
        $emailUtilisateur = $session->get('utilisateur')->getEmailUtilisateur();

        // selectionner les anciennes messages
        $req_old_messages = 
        "SELECT ".
        "   `message`.`recepteur_message`,".
        "   `message`.`expediteur_message`,".
        "    `message`.`contenu_message`,".
        "    `message`.`date_message`,".
        "   `entite`.`photo_entite`,".
        "   `utilisateur`.`prenom_utilisateur` ".
        "FROM `utilisateur`,`entite`,`message` WHERE ".
        "   `utilisateur`.`entite_utilisateur` = `entite`.`id_entite` AND ".
        "   `utilisateur`.`email_utilisateur` = `message`.`expediteur_message` AND ".
        "    `message`.`expediteur_message` = '".($emailUtilisateur)."' AND ".
        "    `message`.`recepteur_message` = '".($request->attributes->get('id_user'))."'  ".
        "UNION ".
        "SELECT ".
        "   `message`.`recepteur_message`,".
        "   `message`.`expediteur_message`,".
        "    `message`.`contenu_message`,".
        "    `message`.`date_message`,".
        "   `entite`.`photo_entite`,".
        "   `utilisateur`.`prenom_utilisateur`".
        "FROM `utilisateur`,`entite`,`message` WHERE ".
        "   `utilisateur`.`entite_utilisateur` = `entite`.`id_entite` AND ".
        "   `utilisateur`.`email_utilisateur` = `message`.`expediteur_message` AND ".
        "    `message`.`expediteur_message` = '".($request->attributes->get('id_user'))."' AND ".
        "    `message`.`recepteur_message` = '".($emailUtilisateur)."'  ".
        "ORDER BY `date_message`  ASC ";

        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare($req_old_messages);
        $statement->execute();
        $old_messages = $statement->fetchAll();

        // Affecter les emojis dans le message
        for($i=0;$i<count($old_messages);$i++) {
            $old_messages[$i]["contenu_message"] = str_replace(
                ':(',
                ' <img src="/img/icones/1.png" style="height:20px;width:20px"> ', 
                $old_messages[$i]["contenu_message"]
            );
            $old_messages[$i]["contenu_message"] = str_replace(
                ':)',
                ' <img src="/img/icones/2.png" style="height:20px;width:20px"> ', 
                $old_messages[$i]["contenu_message"]
            );
            $old_messages[$i]["contenu_message"] = str_replace(
                ':D',
                ' <img src="/img/icones/3.png" style="height:20px;width:20px"> ', 
                $old_messages[$i]["contenu_message"]
            );
            $old_messages[$i]["contenu_message"] = str_replace(
                ':o',
                ' <img src="/img/icones/4.png" style="height:20px;width:20px"> ', 
                $old_messages[$i]["contenu_message"]
            );
            $old_messages[$i]["contenu_message"] = str_replace(
                ':p',
                ' <img src="/img/icones/5.png" style="height:20px;width:20px"> ', 
                $old_messages[$i]["contenu_message"]
            );
            $old_messages[$i]["contenu_message"] = str_replace(
                'XD',
                ' <img src="/img/icones/6.png" style="height:20px;width:20px"> ', 
                $old_messages[$i]["contenu_message"]
            );
        }

        

        // selectionner la liste des amis

        $req_list_amis = 
        "SELECT ".
            "utilisateur.email_utilisateur, ".
            "utilisateur.prenom_utilisateur, ".
            "entite.nom_entite, ".
            "entite.photo_entite ".
        "FROM utilisateur,entite ".
        "WHERE utilisateur.entite_utilisateur = entite.id_entite AND utilisateur.email_utilisateur IN ".
            "(SELECT `id_utilisateur_liste_amis` ".
                "FROM `liste_amis` ".
                "WHERE `id_ami_liste_amis`= '".($emailUtilisateur)."' ".
            "UNION ".
                "SELECT `id_ami_liste_amis` ".
                "FROM `liste_amis` ".
                "WHERE `id_utilisateur_liste_amis`= '".($emailUtilisateur)."')";

        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare($req_list_amis);
        $statement->execute();
        $list_amis = $statement->fetchAll();

        return $this->render('bassem/messages1.html.twig', array(
            'user2' => $request->attributes->get('id_user'),
            'old_messages' => $old_messages,
            'list_amis' => $list_amis,
            )
        );
    }

    /**
     * @Route("/messages/", name="messages2")
     */
    public function messages2Action(Request $request)
    {
        // charger la session
        $session = $request->getSession();

        // redirection de l'utilisateur vers page login en cas ou il n'est pas connecté
        if(!$session->get('utilisateur')){
            return $this->redirectToRoute('login');
        }

        // l'utilisateur est connecté 
        $emailUtilisateur = $session->get('utilisateur')->getEmailUtilisateur();

        // selectionner la liste des amis
        $req_list_amis = 
        "SELECT ".
            "utilisateur.email_utilisateur, ".
            "utilisateur.prenom_utilisateur, ".
            "entite.nom_entite, ".
            "entite.photo_entite ".
        "FROM utilisateur,entite ".
        "WHERE utilisateur.entite_utilisateur = entite.id_entite AND utilisateur.email_utilisateur IN ".
            "(SELECT `id_utilisateur_liste_amis` ".
                "FROM `liste_amis` ".
                "WHERE `id_ami_liste_amis`= '".($emailUtilisateur)."' ".
            "UNION ".
                "SELECT `id_ami_liste_amis` ".
                "FROM `liste_amis` ".
                "WHERE `id_utilisateur_liste_amis`= '".($emailUtilisateur)."')";

        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare($req_list_amis);
        $statement->execute();
        $list_amis = $statement->fetchAll();

        return $this->render('bassem/messages1.html.twig', array(
                'user2' => null,
                'old_messages' => null,
                'list_amis' => $list_amis,
            )
        );
    }

}