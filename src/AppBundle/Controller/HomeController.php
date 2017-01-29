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

class HomeController extends Controller
{

    /**
     * @Route("/home", name="home")
     */
    public function homeAction(Request $request)
    {
        // charger la session
        $session = $request->getSession();

        // redirection de l'utilisateur vers page login en cas ou il n'est pas connecté
        if(!$session->get('utilisateur')){
            return $this->redirectToRoute('login');
        }

        // ************************** SAFA ***************************************
        // **********  SELECTIONNER LES PUBLICATIONS DES AMIS ********************

        $req_publications_amis = 
        "SELECT * FROM publication,entite,utilisateur ".
        "WHERE ".
        "    publication.admin_publication = entite.id_entite AND ".
        "    utilisateur.entite_utilisateur = entite.id_entite AND ".
        "    publication.admin_publication IN (".
        "    SELECT ".
        "        entite.id_entite".
        "    FROM ".
        "        utilisateur,entite ".
        "    WHERE ".
        "        utilisateur.entite_utilisateur = entite.id_entite AND ".
        "        utilisateur.email_utilisateur IN ".
        "        (SELECT `id_utilisateur_liste_amis` ".
        "         FROM `liste_amis` ".
        "         WHERE `id_ami_liste_amis`= '".
                  $session->get('utilisateur')->getEmailUtilisateur()."' ".
        "         UNION ".
        "         SELECT `id_ami_liste_amis` ".
        "         FROM `liste_amis` ".
        "         WHERE `id_utilisateur_liste_amis`= '".
                  $session->get('utilisateur')->getEmailUtilisateur()."')".
        "   )".
        " ORDER BY `date_publication`  DESC  ;";

        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare($req_publications_amis);
        $statement->execute();

        $publications_amis = $statement->fetchAll();


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
        "        publication.admin_publication IN (".
        "        SELECT ".
        "            entite.id_entite".
        "        FROM ".
        "            utilisateur,entite ".
        "        WHERE ".
        "            utilisateur.entite_utilisateur = entite.id_entite AND ".
        "            utilisateur.email_utilisateur IN ".
        "            (SELECT `id_utilisateur_liste_amis` ".
        "             FROM `liste_amis` ".
        "             WHERE `id_ami_liste_amis`= '".
                      $session->get('utilisateur')->getEmailUtilisateur()."' ".
        "             UNION ".
        "             SELECT `id_ami_liste_amis` ".
        "             FROM `liste_amis` ".
        "             WHERE `id_utilisateur_liste_amis`= '".
                      $session->get('utilisateur')->getEmailUtilisateur()."')));";

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
        "        publication.admin_publication IN (".
        "        SELECT ".
        "            entite.id_entite".
        "        FROM ".
        "            utilisateur,entite ".
        "        WHERE ".
        "            utilisateur.entite_utilisateur = entite.id_entite AND ".
        "            utilisateur.email_utilisateur IN ".
        "            (SELECT `id_utilisateur_liste_amis` ".
        "             FROM `liste_amis` ".
        "             WHERE `id_ami_liste_amis`= '".
                      $session->get('utilisateur')->getEmailUtilisateur()."' ".
        "             UNION ".
        "             SELECT `id_ami_liste_amis` ".
        "             FROM `liste_amis` ".
        "             WHERE `id_utilisateur_liste_amis`= '".
                      $session->get('utilisateur')->getEmailUtilisateur()."')".
        "       )".
        ")".
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


        // ************************** selectionner activité des amis
        $req_activity_amis = 
        "SELECT ".
        "    publication.id_publication, ".
        "    publication.date_publication, ".
        "    utilisateur.email_utilisateur, ".
        "    utilisateur.prenom_utilisateur, ".
        "    entite.nom_entite, ".
        "    entite.photo_entite ".
        "FROM ".
        "    `publication`,".
        "    utilisateur,".
        "    entite ".
        "WHERE ".
        "    utilisateur.entite_utilisateur = entite.id_entite AND ".
        "    publication.admin_publication = entite.id_entite AND ".
        "    publication.admin_publication IN ( ".
        "        SELECT entite.id_entite ".
        "        FROM ".
        "            utilisateur,".
        "            entite ".
        "        WHERE ".
        "            utilisateur.entite_utilisateur = entite.id_entite AND ".
        "            utilisateur.email_utilisateur IN ( ".
        "                SELECT `id_utilisateur_liste_amis` ".
        "                FROM `liste_amis` ".
        "                WHERE ".
        "                   `id_ami_liste_amis`= '".
                            $session->get('utilisateur')->getEmailUtilisateur()."' ".
        "                UNION ".
        "                SELECT `id_ami_liste_amis` ".
        "                FROM `liste_amis` ".
        "                WHERE ".
        "                    `id_utilisateur_liste_amis`= '".$session->get('utilisateur')->getEmailUtilisateur()."'".
        "                )".
        "       ) ORDER BY publication.date_publication DESC LIMIT 5";

        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare($req_activity_amis);
        $statement->execute();
        $activity_amis = $statement->fetchAll();


        $format_date = "";
        $localDate = date('Y-m-d H:i:s', time());
        $localDate = date_create($localDate);

        for ($i=0; $i < count($activity_amis) ; $i++) { 
            // variable local
            $date = date_create_from_format('Y-m-d H:i:s', $activity_amis[$i]["date_publication"]);
            
            if(date_format($localDate,'Y') > date_format($date,'Y')){
                $activity_amis[$i]["date_publication"] = 
                    date_format($localDate,'Y') - date_format($date,'Y');
                $format_date = "ans";
            }else if(date_format($localDate,'m') > date_format($date,'m')){
                $activity_amis[$i]["date_publication"] = 
                    date_format($localDate,'m') - date_format($date,'m');;
                $format_date = "mois";
            }else if(date_format($localDate,'d') > date_format($date,'d')){
                $activity_amis[$i]["date_publication"] = 
                    date_format($localDate,'d') - date_format($date,'d');;
                $format_date = "jours";
            }else if(date_format($localDate,'H') > date_format($date,'H')){
                $activity_amis[$i]["date_publication"] = 
                    date_format($localDate,'H') - date_format($date,'H');;
                $format_date = "heurs";
            }else if(date_format($localDate,'i') > date_format($date,'i')){
                $activity_amis[$i]["date_publication"] = 
                    date_format($localDate,'i') - date_format($date,'i');;
                $format_date = "minutes";
            }else{
                $activity_amis[$i]["date_publication"] = 
                    date_format($localDate,'s') - date_format($date,'s');;
                $format_date = "secondes";
            }
            $activity_amis[$i]["format_date"] = $format_date;
            
        }

        // ************************** Connaissez-vous...
        $req_connaissez_vous = 
        "SELECT ".
        "    utilisateur.email_utilisateur, ".
        "    utilisateur.origine_utilisateur, ".
        "    utilisateur.prenom_utilisateur, ".
        "    entite.nom_entite, ".
        "    entite.photo_entite ".
        "FROM utilisateur,entite ".
        "WHERE ".
        "    utilisateur.entite_utilisateur = entite.id_entite AND ".
        "    utilisateur.email_utilisateur IN (".
        "        SELECT `id_utilisateur_liste_amis` ".
        "        FROM `liste_amis` ".
        "        WHERE ".
        "            `id_utilisateur_liste_amis` != '".
                    $session->get('utilisateur')->getEmailUtilisateur()."' AND ".
        "            `id_ami_liste_amis` IN (".
        "                SELECT `id_utilisateur_liste_amis` ".
        "                FROM `liste_amis` ".
        "                WHERE ".
        "                    `id_ami_liste_amis`= '".
                    $session->get('utilisateur')->getEmailUtilisateur()."' ".
        "                UNION ".
        "                SELECT `id_ami_liste_amis` ".
        "                FROM `liste_amis` ".
        "                WHERE `id_utilisateur_liste_amis`= '".
                    $session->get('utilisateur')->getEmailUtilisateur()."')".
        "        UNION ".
        "        SELECT `id_ami_liste_amis` ".
        "        FROM `liste_amis` ".
        "        WHERE `id_ami_liste_amis` != '".
                    $session->get('utilisateur')->getEmailUtilisateur()."' AND ".
        "                `id_utilisateur_liste_amis` IN (".
        "                SELECT `id_utilisateur_liste_amis` ".
        "                FROM `liste_amis` ".
        "                WHERE ".
        "                    `id_ami_liste_amis`= '".
                    $session->get('utilisateur')->getEmailUtilisateur()."' ".
        "                UNION ".
        "                SELECT `id_ami_liste_amis` ".
        "                FROM `liste_amis` ".
        "                WHERE `id_utilisateur_liste_amis`= '".$session->get('utilisateur')->getEmailUtilisateur()."')) LIMIT 5 ";
        
        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare($req_connaissez_vous);
        $statement->execute();
        $connaissez_vous = $statement->fetchAll();


        return $this->render('bassem/home.html.twig', array(
                'list_aime' => $list_aime,
                'activity_amis' => $activity_amis,
                'connaissez_vous' => $connaissez_vous,
                'publications_amis' => $publications_amis,
                'commentaires_amis' => $commentaires_amis,
                'my_likes' => $my_likes,
            )
        );
    }
}