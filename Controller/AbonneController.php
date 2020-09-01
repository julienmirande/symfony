<?php

namespace MonBundle\Controller;

use MonBundle\Entity\Abonne;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Abonne controller.
 *
 */
class AbonneController extends Controller
{

  /**
   * Lists all abonne entities.
   *
   */
  public function indexAction()
  {
      $em = $this->getDoctrine()->getManager();

      $abonnes = $em->getRepository('MonBundle:Abonne')->findAll();

      return $this->render('MonBundle:abonne:index.html.twig', array(
          'abonnes' => $abonnes,
      ));
  }

    /**
     * Lists all abonne entities.
     *
     */
    public function panierAction()
    {
        $em = $this->getDoctrine()->getManager();

        $codeAbonne = $this->getUser()->getCodeAbonne();
        $achats = $em->getRepository('MonBundle:Achat')->findBy(array('codeAbonne' => $codeAbonne));



        return $this->render('MonBundle:Menu:panier.html.twig', array(
            'achats' => $achats,
        ));
    }

    /**
     * Creates a new abonne entity.
     *
     */
    public function newAction(Request $request)
    {


        $abonne = new Abonne();
        $form = $this->createForm('MonBundle\Form\AbonneType', $abonne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

          $em = $this->getDoctrine()->getManager();
          $em->persist($abonne);
          $em->flush();

            // $nom = $abonne->getNomAbonne();
            // $prenom = $abonne->getPrenomAbonne();
            // $email = $abonne->getEmail();
            // $login = $abonne->getLogin();
            // $password = $abonne->getPassword();
            // $adresse = $abonne->getAdresse();
            // $ville = $abonne->getVille();
            // $codePostal = $abonne->getCodePostal();
            // $credit = $abonne->getCredit();
            // $pays = $abonne->getCodePays();
            //
            //
            //
            // $em = $this->getDoctrine()->getManager();
            // // $sql = $em->createQuery( //creation de la requête
            // //   "SELECT p.codePays
            // //    FROM  MonBundle:Pays p
            // //    WHERE p.codePays = :nom")
            // //   ->setParameter( 'nom' , $abonne->getCodePays());
            // //
            // //   $pays = $sql->getResult();
            //
            //
            // $changes = $em->getConnection()->insert('Abonne', array('Nom_Abonne' => $nom ,'Prenom_Abonne' => $prenom ,'Email' => $email,
            //  'Login' => $login, 'Password' => $password,'Adresse' => $adresse,'Ville' => $ville,'Code_Postal' => $codePostal,'Credit' => $credit, 'Pays' => $pays));
            //
            //  $em->flush();

            return $this->redirectToRoute('mon_accueil');

            // return $this->get('security.authentication.guard_handler')->authenticateUserAndHandleSuccess(
            //   $user,
            //   $request,
            //   $this->get('app.security.login_form_authenticator'),
            //   'main',
            // );
        }

        return $this->render('MonBundle:abonne:new.html.twig', array(
            'abonne' => $abonne,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a abonne entity.
     *
     */
    public function showAction(Abonne $abonne)
    {
        $deleteForm = $this->createDeleteForm($abonne);

        return $this->render('MonBundle:abonne:show.html.twig', array(
            'abonne' => $abonne,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing abonne entity.
     *
     */
    public function editAction(Request $request, Abonne $abonne)
    {
        $deleteForm = $this->createDeleteForm($abonne);
        $editForm = $this->createForm('MonBundle\Form\AbonneType', $abonne);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('abonne_show', array('codeAbonne' => $abonne->getCodeabonne()));
        }

        return $this->render('MonBundle:abonne:edit.html.twig', array(
            'abonne' => $abonne,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a abonne entity.
     *
     */
    public function deleteAction(Request $request, Abonne $abonne)
    {
        $form = $this->createDeleteForm($abonne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($abonne);
            $em->flush();
        }

        return $this->redirectToRoute('abonne_index');
    }

    /**
     * Creates a form to delete a abonne entity.
     *
     * @param Abonne $abonne The abonne entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Abonne $abonne)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('abonne_delete', array('codeAbonne' => $abonne->getCodeabonne())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function loginAction(Request $request)
    {
      // Si le visiteur est déjà identifié, on le redirige vers l'accueil
         // if (false === $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
         //   return $this->redirectToRoute('mon_accueil');
         // }

       // Le service authentication_utils permet de récupérer le nom d'utilisateur
       // et l'erreur dans le cas où le formulaire a déjà été soumis mais était invalide
       // (mauvais mot de passe par exemple)
       $authenticationUtils = $this->get('security.authentication_utils');

       return $this->render('MonBundle:Menu:connexion.html.twig', array(
         'login' => $authenticationUtils->getLastUsername(),
         'error' => $authenticationUtils->getLastAuthenticationError(),
       ));
    }
}
