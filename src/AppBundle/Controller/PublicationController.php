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

class PublicationController extends Controller
{

    /**
     * @Route("/supprimer_publication/{id_publication}/", name="supprimer_publication")
     */
    public function supprimerPublicationAction(Request $request)
    {
        // charger la session
        $session = $request->getSession();

        // redirection de l'utilisateur vers page login en cas ou il n'est pas connecté
        if(!$session->get('utilisateur')){
            return $this->redirectToRoute('login');
        }

        $id_publication = $request->attributes->get('id_publication');

        $publication = new Publication();
        
        $publication = $this->getDoctrine()
                ->getRepository('AppBundle:Publication')
                ->findOneBy(array(
                    'idPublication'=>$id_publication,
                    ));

        if($publication){

            // tester celui qui va supprimer le commentaire est le propriaitaire
            if($publication->getAdminPublication()->getIdEntite() == $session->get('entite')->getIdEntite()){

                $em = $this->getDoctrine()->getEntityManager();
                $em->remove($publication);
                $em->flush();
            }else{
                return $this->redirectToRoute("home");
            }
        }

        return $this->redirect('/user/'.$session->get('utilisateur')->getEmailUtilisateur());
    }


    /**
     * @Route("/publication/{id_publication}/", name="publication")
     */
    public function publicationAction(Request $request)
    {
        // charger la session
        $session = $request->getSession();

        // redirection de l'utilisateur vers page login en cas ou il n'est pas connecté
        if(!$session->get('utilisateur')){
            return $this->redirectToRoute('login');
        }

        $id_publication = $request->attributes->get('id_publication');

        $publication = new Publication();
        $publication = $this->getDoctrine()
                ->getRepository('AppBundle:Publication')
                ->findOneBy(array(
                    'idPublication'=>$id_publication));


        if ($publication) {
            $utilisateur = new Utilisateur();
            $utilisateur = $this->getDoctrine()
                    ->getRepository('AppBundle:Utilisateur')
                    ->findOneBy(array(
                        'entiteUtilisateur'=>$publication->getAdminPublication()));


            // ******************************************************
            // *****  SELECTIONNER LES COMMENTAIRES DES AMIS ********

            $req_commentaires_amis = 
            "SELECT * FROM commentaire,utilisateur,entite ".
            "WHERE  ".
            "    utilisateur.entite_utilisateur = entite.id_entite AND  ".
            "    commentaire.admin_commentaire = utilisateur.email_utilisateur AND ".
            "    commentaire.publication_commentaire = ".$id_publication;

            $em = $this->getDoctrine()->getManager();
            $connection = $em->getConnection();
            $statement = $connection->prepare($req_commentaires_amis);
            $statement->execute();

            $commentaires_amis = $statement->fetchAll();

            // ****************************************************************
            // *******  SELECTIONNER LES AIMES DES PUBLICATIONS DES AMIS ******

            $req_list_aime = 
            "SELECT aime_pub.id_publication_aime_pub, COUNT(aime_pub.id_publication_aime_pub) AS nbr_aime  ".
            "FROM aime_pub ".
            "WHERE aime_pub.id_publication_aime_pub = ".$id_publication.
            " GROUP BY aime_pub.id_publication_aime_pub";

            $em = $this->getDoctrine()->getManager();
            $connection = $em->getConnection();
            $statement = $connection->prepare($req_list_aime);
            $statement->execute();

            $list_aime = $statement->fetchAll();

            // ****************************************************************
            // *******  VERIFIER SI LA PUBLICATION EST AIMER PAR USER CONNECTED ******

            $req_is_liked = 
            "SELECT * FROM `aime_pub` WHERE `id_utilisateur_aime_pub` = '".$session->get('utilisateur')->getEmailUtilisateur()."' AND `id_publication_aime_pub` = ".$id_publication;

            $em = $this->getDoctrine()->getManager();
            $connection = $em->getConnection();
            $statement = $connection->prepare($req_is_liked);
            $statement->execute();

            $is_liked = $statement->fetchAll();
            if ($is_liked) {
                $is_liked = 1;
            }


            
        }else{
            return $this->redirectToRoute('home');
        }
        
        return $this->render('bassem/publication.html.twig', array(
                'publication' => $publication,
                'utilisateur' => $utilisateur,
                'commentaires_amis' => $commentaires_amis,
                'list_aime' => $list_aime,
                'is_liked' => $is_liked,
            ));
    }



    /**
     * @Route("/ne_pas_aimer/{id_publication}/", name="ne_pas_aimer_publication")
     */
    public function ne_pas_aimerPublicationAction(Request $request)
    {
        // charger la session
        $session = $request->getSession();

        // redirection de l'utilisateur vers page login en cas ou il n'est pas connecté
        if(!$session->get('utilisateur')){
            return $this->redirectToRoute('login');
        }

        $id_publication = $request->attributes->get('id_publication');


        if ($id_publication) {
            try{
                $req_ne_pas_aimer_publication = 
                "DELETE FROM `aime_pub` WHERE `aime_pub`.`id_publication_aime_pub` = ".$id_publication." AND `aime_pub`.`id_utilisateur_aime_pub` = '".$session->get('utilisateur')->getEmailUtilisateur()."' AND `aime_pub`.`emoji_aime_pub` = 'j\'aime'";

                $em = $this->getDoctrine()->getManager();
                $connection = $em->getConnection();
                $statement = $connection->prepare($req_ne_pas_aimer_publication);
                $statement->execute();
            } catch(\Exception $e){
                
            }
        }
        
        return $this->redirect('/publication/'.$id_publication);
    }



    /**
     * @Route("/aimer/{id_publication}", name="aimer_publication")
     */
    public function aimerPublicationAction(Request $request)
    {
        // charger la session
        $session = $request->getSession();

        // redirection de l'utilisateur vers page login en cas ou il n'est pas connecté
        if(!$session->get('utilisateur')){
            return $this->redirectToRoute('login');
        }

        $id_publication = $request->attributes->get('id_publication');


        if ($id_publication) {
            try{
                $req_aimer_publication = 
                "INSERT INTO `aime_pub` (`id_publication_aime_pub`, `id_utilisateur_aime_pub`, `emoji_aime_pub`) VALUES ('".$id_publication."', '".$session->get('utilisateur')->getEmailUtilisateur()."', 'j\'aime');";

                $em = $this->getDoctrine()->getManager();
                $connection = $em->getConnection();
                $statement = $connection->prepare($req_aimer_publication);
                $statement->execute();


                // INSERER L'ACTION DANS TABLE DE NOTIFICATION
                $req_aimer_publication = 
                "INSERT INTO `notification` (`acteur_notification`, `id_publication_notification`, `date_notification`, `type_notification`) VALUES ('".$session->get('utilisateur')->getEmailUtilisateur()."', '".$id_publication."', CURRENT_TIMESTAMP, 'j\'aime');";

                $em = $this->getDoctrine()->getManager();
                $connection = $em->getConnection();
                $statement = $connection->prepare($req_aimer_publication);
                $statement->execute();

            } catch(\Exception $e){
                
            }
        }
        
        return $this->redirect('/publication/'.$id_publication);
    }

    
    /**
     * @Route("/aime_publication_users/{id_publication}/", name="aime_publication_users")
     */
    public function aimePublicationUsersAction(Request $request)
    {
        // charger la session
        $session = $request->getSession();

        // redirection de l'utilisateur vers page login en cas ou il n'est pas connecté
        if(!$session->get('utilisateur')){
            return $this->redirectToRoute('login');
        }

        $id_publication = $request->attributes->get('id_publication');

        if ($id_publication) {
            // selectionner la liste des amis
            $req_aime_publication_users = 
            "SELECT * FROM `aime_pub`,utilisateur,entite WHERE aime_pub.`id_publication_aime_pub` = ".
            $id_publication." AND aime_pub.id_utilisateur_aime_pub = utilisateur.email_utilisateur AND utilisateur.entite_utilisateur = entite.id_entite";

            $em = $this->getDoctrine()->getManager();
            $connection = $em->getConnection();
            $statement = $connection->prepare($req_aime_publication_users);
            $statement->execute();
            $aime_publication_users = $statement->fetchAll();

            return $this->render('bassem/users.html.twig', array(
                'aime_publication_users' => $aime_publication_users,
                )
            );

        }
        
        return $this->redirectToRoute('home');
    }

}