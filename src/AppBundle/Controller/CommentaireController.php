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

class CommentaireController extends Controller
{

    /**
     * @Route("/ajouter_commentaire/{id}/", name="ajouter_commentaire")
     */
    public function ajouterCommentaireAction(Request $request)
    {
        // charger la session
        $session = $request->getSession();

        // redirection de l'utilisateur vers page login en cas ou il n'est pas connecté
        if(!$session->get('utilisateur')){
            return $this->redirectToRoute('login');
        }

        $id = $request->attributes->get('id');
        $commentaire = $request->request->get('commentaire');

        $req_insert_commentire ="INSERT INTO `commentaire`(`admin_commentaire`, `contenu_commentaire`, `publication_commentaire`) VALUES ('".$session->get('utilisateur')->getEmailUtilisateur()."','".$commentaire."','".$id."')";
        
        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare($req_insert_commentire);
        $statement->execute();


        // AJOUTER L'ACTION DANS LA TABLE DE NOTIFICATION
        $req_insert_commentire ="INSERT INTO `notification` (`acteur_notification`, `id_publication_notification`, `date_notification`, `type_notification`) VALUES ('".$session->get('utilisateur')->getEmailUtilisateur()."', '".$id."', CURRENT_TIMESTAMP, 'commentaire');";
        
        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare($req_insert_commentire);
        $statement->execute();



        return $this->redirect('/publication/'.$id);
    }

    /**
     * @Route("/supprimer_commentaire/{id}/", name="supprimer_commentaire")
     */
    public function supprimerCommentaireAction(Request $request)
    {
        // charger la session
        $session = $request->getSession();

        // redirection de l'utilisateur vers page login en cas ou il n'est pas connecté
        if(!$session->get('utilisateur')){
            return $this->redirectToRoute('login');
        }

        $id = $request->attributes->get('id');

        $commentaire = new Commentaire();
        
        $commentaire = $this->getDoctrine()
                ->getRepository('AppBundle:Commentaire')
                ->findOneBy(array(
                    'idCommentaire'=>$id,
                    ));

        if($commentaire){
            $id_publication = $commentaire->getPublicationCommentaire()->getIdPublication();

            // tester celui qui va supprimer le commentaire est le propriaitaire
            if($commentaire->getAdminCommentaire()->getEmailUtilisateur() == $session->get('utilisateur')->getEmailUtilisateur()){

                $em = $this->getDoctrine()->getEntityManager();
                $em->remove($commentaire);
                $em->flush();
            }
        }else{
            //commentaire n'existe pas;

        }

        return $this->redirect('/publication/'.$id_publication);
    }
}