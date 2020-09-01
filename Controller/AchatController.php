<?php

namespace MonBundle\Controller;

use MonBundle\Entity\Achat;
use MonBundle\Entity\Abonne;
use MonBundle\Entity\Enregistrement;
use MonBundle\Entity\Album;
use MonBundle\Entity\Disque;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
* Achat controller.
*
*/
class AchatController extends Controller
{

  public function validerAction(Request $request){

    $achatConfirme =true;
    $abonne = $this->getUser();
    $codeAbonne = $this->getUser()->getCodeAbonne();


    $em = $this->getDoctrine()->getManager();
    $query1 = $em->createQuery( //creation de la requête
      "SELECT a
      FROM MonBundle:Achat a
      WHERE a.codeAbonne= :codeAbonne")
      ->setParameter( 'codeAbonne' , $codeAbonne);

      $achats = $query1->getResult(); //variable qui récupère la requête

      foreach($achats as $achat)
      {
        $product = $em->getRepository(Achat::class)->find($achat->getCodeAchat());

        if (!$product) {
          throw $this->createNotFoundException(
            'No product found for id '.$id
          );
        }

        $product->setAchatConfirme($achatConfirme);
        $em->flush();
      }

      $query = $em->createQuery(
        'DELETE MonBundle:Achat a
        WHERE a.codeAbonne = :code')
        ->setParameter("code", $codeAbonne);

        $query->getResult();


        return $this->render('MonBundle:achat:valider.html.twig', array());
      }


      public function addPanierAction(Enregistrement $codeEnregistrement,$codeAlbum){

        $em = $this->getDoctrine()->getManager();

        $abonne = $this->getUser();
        $codeAbonne = $this->getUser()->getCodeAbonne();

        $achat = new Achat();
        $achat->setCodeAbonne( $abonne  );
        $achat->setCodeEnregistrement($codeEnregistrement);


        $em->persist($achat);
        $em->flush();

        return $this->redirectToRoute('album_show', array('codeAlbum' => $codeAlbum));
      }

      public function addAllPanierAction(Disque $codeDisque,$codeAlbum){
        $em = $this->getDoctrine()->getManager();

        $abonne = $this->getUser();
        $codeAbonne = $this->getUser()->getCodeAbonne();

        $query3 = $em->createQuery( //creation de la requête
          "SELECT e.titre,e.duree,e.codeMorceau
          FROM MonBundle:Disque d
          INNER JOIN MonBundle:CompositionDisque cd WITH d = cd.codeDisque
          INNER JOIN MonBundle:Enregistrement e WItH e = cd.codeMorceau
          WHERE d.codeDisque = :codeDisque")
          ->setParameter( 'codeDisque' , $codeDisque)
          ->setMaxResults(10);

          $enregistrements = $query3->getResult(); //variable qui récupère la requête

          // $sql = " INSERT INTO Achat (Code_Abonne,Code_Enregistrement) VALUES ('$codeAbonne',:code)";
          //   $stmt = $em->getConnection()->prepare($sql);
          //   $stmt->bindValue("code", $enregistrement->getCodeMorceau());
          //   $stmt->execute();

          $taille = count($enregistrements);
          for ($i = 0; $i < $taille; $i++)
          {

            $sql = " INSERT INTO Achat (Code_Abonne,Code_Enregistrement) VALUES ('$codeAbonne',:code)";
              $stmt = $em->getConnection()->prepare($sql);
              $stmt->bindValue("code", $enregistrements[$i]['codeMorceau']);
              $stmt->execute();

          }

           return $this->redirectToRoute('album_show', array('codeAlbum' => $codeAlbum));
        }

        public function removePanierAction(Request $request, Achat $achat){

          $em = $this->getDoctrine()->getManager();

          $abonne = $this->getUser();
          $codeAbonne = $this->getUser()->getCodeAbonne();


          $achat = $em->getRepository('MonBundle:Achat')->find($achat);

          $em->remove($achat);
          $em->flush();

          return $this->redirectToRoute('abonne_panier', array('codeAbonne' => $codeAbonne));
        }

        public function removeAllPanierAction(Request $request){

          $abonne = $this->getUser();
          $codeAbonne = $this->getUser()->getCodeAbonne();

          $em = $this->getDoctrine()->getManager();
          $query = $em->createQuery(
            'DELETE MonBundle:Achat a
            WHERE a.codeAbonne = :code')
            ->setParameter("code", $codeAbonne);

            $query->getResult();

            return $this->redirectToRoute('abonne_panier', array('codeAbonne' => $codeAbonne));
          }


          /**
          * Lists all achat entities.
          *
          */
          public function indexAction()
          {
            $em = $this->getDoctrine()->getManager();

            $achats = $em->getRepository('MonBundle:Achat')->findAll();

            return $this->render('MonBundle:achat:index.html.twig', array(
              'achats' => $achats,
            ));
          }

          /**
          * Creates a new achat entity.
          *
          */
          public function newAction(Request $request)
          {
            $achat = new Achat();
            $form = $this->createForm('MonBundle\Form\AchatType', $achat);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
              $em = $this->getDoctrine()->getManager();
              $em->persist($achat);
              $em->flush();

              return $this->redirectToRoute('Achat_show', array('codeAchat' => $achat->getCodeachat()));
            }

            return $this->render('MonBundle:achat:new.html.twig', array(
              'achat' => $achat,
              'form' => $form->createView(),
            ));
          }

          /**
          * Finds and displays a achat entity.
          *
          */
          public function showAction(Achat $achat)
          {
            $deleteForm = $this->createDeleteForm($achat);

            return $this->render('MonBundle:achat:show.html.twig', array(
              'achat' => $achat,
              'delete_form' => $deleteForm->createView(),
            ));
          }

          /**
          * Displays a form to edit an existing achat entity.
          *
          */
          public function editAction(Request $request, Achat $achat)
          {
            $deleteForm = $this->createDeleteForm($achat);
            $editForm = $this->createForm('MonBundle\Form\AchatType', $achat);
            $editForm->handleRequest($request);

            if ($editForm->isSubmitted() && $editForm->isValid()) {
              $this->getDoctrine()->getManager()->flush();

              return $this->redirectToRoute('Achat_edit', array('codeAchat' => $achat->getCodeachat()));
            }

            return $this->render('MonBundle:achat:edit.html.twig', array(
              'achat' => $achat,
              'edit_form' => $editForm->createView(),
              'delete_form' => $deleteForm->createView(),
            ));
          }

          /**
          * Deletes a achat entity.
          *
          */
          public function deleteAction(Request $request, Achat $achat)
          {
            $form = $this->createDeleteForm($achat);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
              $em = $this->getDoctrine()->getManager();
              $em->remove($achat);
              $em->flush();
            }

            return $this->redirectToRoute('Achat_index');
          }

          /**
          * Creates a form to delete a achat entity.
          *
          * @param Achat $achat The achat entity
          *
          * @return \Symfony\Component\Form\Form The form
          */
          private function createDeleteForm(Achat $achat)
          {
            return $this->createFormBuilder()
            ->setAction($this->generateUrl('Achat_delete', array('codeAchat' => $achat->getCodeachat())))
            ->setMethod('DELETE')
            ->getForm()
            ;
          }
        }
