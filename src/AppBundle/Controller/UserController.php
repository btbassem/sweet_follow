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

class UserController extends Controller
{


    /**
     * @Route("/user/{email_utilisateur}/", name="user")
     */
    public function userAction(Request $request)
    {
        // charger la session
        $session = $request->getSession();

        // redirection de l'utilisateur vers page login en cas ou il n'est pas connecté
        if(!$session->get('utilisateur')){
            return $this->redirectToRoute('login');
        }
        $email_utilisateur = $request->attributes->get('email_utilisateur');

        // ******************* AJOUTER PUBLICATION ******************************
        // **********************************************************************

        $publication = new Publication();
        $form_publication = $this->createFormBuilder($publication)
            ->add('contenuPublication', TextareaType::class, 
                array('attr' => array(
                    'class' => 'form-control input-lg p-text-area',
                    'placeholder' => 'Exprimez-vous', 
                    'rows' => '2')))
            ->add('poster', SubmitType::class, 
                array('attr' => array('class' => 'btn btn-azure pull-right'), 'label' => 'Poster'))
            ->getForm();

        
        $form_publication->handleRequest($request);


        if ($form_publication->isSubmitted() && $form_publication->isValid()) {
            
            $req_ajouter_publication = 
            "INSERT INTO `publication` ( ".
            "    `id_publication`,  ".
            "    `contenu_publication`, ".
            "    `date_publication`, ".
            "    `admin_publication`, ".
            "    `multimedia_publication`) ".
            "VALUES ( ".
            "    NULL, ".
            "    '".$publication->getContenuPublication()."', ".
            "    CURRENT_TIMESTAMP, ".
            "    '".$session->get('entite')->getIdEntite()."', ".
            "    '' ".
            ");";
            
            $em = $this->getDoctrine()->getManager();
            $connection = $em->getConnection();
            $statement = $connection->prepare($req_ajouter_publication);
            $statement->execute();
        }

        // ******************* ENVOYER L'UTILISATEUR ******************************
        // ************************************************************************

        $user = new Utilisateur();

        $user = $this->getDoctrine()
                ->getRepository('AppBundle:Utilisateur')
                ->findOneBy(array(
                    'emailUtilisateur'=>$email_utilisateur));

        if (!$user) {
            return $this->redirectToRoute('home');
        }

        // ******************* ENVOYER LIST D'AMIS * ******************************
        // ************************************************************************

        $req_list_amis = 
        "SELECT ".
            "utilisateur.email_utilisateur, ".
            "entite.photo_entite ".
        "FROM utilisateur,entite ".
        "WHERE utilisateur.entite_utilisateur = entite.id_entite AND utilisateur.email_utilisateur IN ".
            "(SELECT `id_utilisateur_liste_amis` ".
                "FROM `liste_amis` ".
                "WHERE `id_ami_liste_amis`= '".($email_utilisateur)."' ".
            "UNION ".
                "SELECT `id_ami_liste_amis` ".
                "FROM `liste_amis` ".
                "WHERE `id_utilisateur_liste_amis`= '".($email_utilisateur)."')".
        "LIMIT 9";

        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare($req_list_amis);
        $statement->execute();
        $list_amis = $statement->fetchAll();

        // ************************** SAFA ***************************************
        // **********  SELECTIONNER LES PUBLICATIONS DE USER ********************

        $req_publications_amis = 
        "SELECT * FROM publication,entite,utilisateur ".
        "WHERE ".
        "    publication.admin_publication = entite.id_entite AND ".
        "    utilisateur.entite_utilisateur = entite.id_entite AND ".
        "    publication.admin_publication =  '".$user->getEntiteUtilisateur()->getIdEntite()."'".
        " ORDER BY `date_publication`  DESC  ;";

        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare($req_publications_amis);
        $statement->execute();

        $publications = $statement->fetchAll();


        // ************************** SAFA ***************************************
        // *****  SELECTIONNER LES COMMENTAIRES DES AMIS ********

        $req_commentaires_amis = 
        "SELECT * FROM commentaire,utilisateur,entite ".
        "WHERE  ".
        "    utilisateur.entite_utilisateur = entite.id_entite AND  ".
        "    commentaire.admin_commentaire = utilisateur.email_utilisateur AND ".
        "    commentaire.publication_commentaire IN ( ".
        "    SELECT publication.id_publication FROM publication ".
        "    WHERE  ".
        "        publication.admin_publication = '".
                 $user->getEntiteUtilisateur()->getIdEntite()."')";

        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare($req_commentaires_amis);
        $statement->execute();

        $commentaires_amis = $statement->fetchAll();


        // ************************** SAFA ***************************************
        // *******  SELECTIONNER LES AIMES DES PUBLICATIONS DES AMIS *************

        $req_list_aime = 
        "SELECT aime_pub.id_publication_aime_pub, COUNT(aime_pub.id_publication_aime_pub) AS nbr_aime  ".
        "FROM aime_pub ".
        "WHERE aime_pub.id_publication_aime_pub IN (".
        "    SELECT publication.id_publication FROM publication,entite,utilisateur ".
        "    WHERE ".
        "        publication.admin_publication = entite.id_entite AND ".
        "        utilisateur.entite_utilisateur = entite.id_entite AND ".
        "        publication.admin_publication = ".$user->getEntiteUtilisateur()->getIdEntite().") ".
        "GROUP BY aime_pub.id_publication_aime_pub";

        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare($req_list_aime);
        $statement->execute();

        $list_aime = $statement->fetchAll();


        // ************************** SAFA ***************************************
        // **********  SELECTIONNER MES J'AIMES SUR LES PUBLICATIONS *************

        $req_my_likes = 
        "SELECT * FROM `aime_pub` WHERE `id_utilisateur_aime_pub` = '".
        $session->get('utilisateur')->getEmailUtilisateur()."'";

        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare($req_my_likes);
        $statement->execute();

        $my_likes = $statement->fetchAll();

        // ***************************** ANAS ************************************
        // ******************  SELECTIONNER ETAT D'AMITIER ***********************

        // VERIFIER S'IL SONT DES AMIS
        $req_isFriend = 
        "SELECT * FROM `liste_amis` WHERE (`id_utilisateur_liste_amis` = '".$session->get('utilisateur')->getEmailUtilisateur()."' AND `id_ami_liste_amis` = '".$email_utilisateur."') OR (`id_utilisateur_liste_amis` = '".$email_utilisateur."' AND `id_ami_liste_amis` = '".$session->get('utilisateur')->getEmailUtilisateur()."')";

        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare($req_isFriend);
        $statement->execute();

        $isFriend = $statement->fetchAll();

        if ($isFriend) {
            $isFriend = 1;
            $demandeurAmi = 0;
            $recepteurAmi = 0;
        }else{
            $isFriend = 0;
        }

        // IL NE SONT PAS DES AMIS => VERIFIER SI L'UTILISATEUR CONNECTÉ A ENVOYER UNE INVITATION À CET UTILISATEUR
        if (!$isFriend) {

            $req_demandeurAmi = 
            "SELECT * FROM `liste_attente` WHERE `id_demandeur_liste_attente` = '".$session->get('utilisateur')->getEmailUtilisateur()."' AND `id_recepteur_liste_attente` = '".$email_utilisateur."'";

            $em = $this->getDoctrine()->getManager();
            $connection = $em->getConnection();
            $statement = $connection->prepare($req_demandeurAmi);
            $statement->execute();

            $demandeurAmi = $statement->fetchAll();

            if ($demandeurAmi) {
                $demandeurAmi = 1;
                $recepteurAmi = 0;
            }else{
                $demandeurAmi = 0;
            }

            // VERIFIER QUE CET UTILISATEUR À ENVOYER UNE INVITATION À UTILISATEUR CONNECTÉ 
            if (!$demandeurAmi) {
                $req_recepteurAmi = 
                "SELECT * FROM `liste_attente` WHERE `id_demandeur_liste_attente` = '".$email_utilisateur."' AND `id_recepteur_liste_attente` = '".$session->get('utilisateur')->getEmailUtilisateur()."'";

                $em = $this->getDoctrine()->getManager();
                $connection = $em->getConnection();
                $statement = $connection->prepare($req_recepteurAmi);
                $statement->execute();

                $recepteurAmi = $statement->fetchAll();

                if ($recepteurAmi) {
                    $recepteurAmi = 1;
                }else{
                    $recepteurAmi = 0;
                }
            }
        }
        
        return $this->render('bassem/profile.html.twig', array(
                'my_likes' => $my_likes,
                'list_amis' => $list_amis,
                'form_publication' => $form_publication->createView(),
                'user' => $user,
                'list_aime' => $list_aime,
                'commentaires_amis' => $commentaires_amis,
                'publications' => $publications,
                'isFriend' => $isFriend,
                'demandeurAmi' => $demandeurAmi,
                'recepteurAmi' => $recepteurAmi,
                )
            );
    }
}