<?php

namespace MonBundle\Controller;

use MonBundle\Entity\Instrument;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Instrument controller.
 *
 */
class InstrumentController extends Controller
{
    /**
     * Lists all instrument entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $instruments = $em->getRepository('MonBundle:Instrument')->findAll();

        return $this->render('MonBundle:instrument:index.html.twig', array(
            'instruments' => $instruments,
        ));
    }

    /**
     * Creates a new instrument entity.
     *
     */
    public function newAction(Request $request)
    {
        $instrument = new Instrument();
        $form = $this->createForm('MonBundle\Form\InstrumentType', $instrument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($instrument);
            $em->flush();

            return $this->redirectToRoute('instrument_show', array('codeInstrument' => $instrument->getCodeinstrument()));
        }

        return $this->render('MonBundle:instrument:new.html.twig', array(
            'instrument' => $instrument,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a instrument entity.
     *
     */
    public function showAction(Instrument $instrument)
    {

        $em = $this->getDoctrine()->getManager();

        $query1 = $em->createQuery( //creation de la requête
          "SELECT DISTINCT m.nomMusicien, m.prenomMusicien, m.photo, m.codeMusicien
          FROM MonBundle:Musicien m
          INNER JOIN MonBundle:Composer c WITH m = c.codeMusicien
          WHERE m.codeInstrument =:codeInstrumentInit
          ORDER BY m.nomMusicien ASC")
          ->setParameter( 'codeInstrumentInit' , $instrument->getCodeInstrument());

          $resultat1 = $query1->getResult(); //variable qui récupère la requête

        return $this->render('MonBundle:instrument:show.html.twig', array(
            'instrument' => $instrument,
            'auteurs' => $resultat1,

        ));
    }

    /**
     * Displays a form to edit an existing instrument entity.
     *
     */
    public function editAction(Request $request, Instrument $instrument)
    {
        $deleteForm = $this->createDeleteForm($instrument);
        $editForm = $this->createForm('MonBundle\Form\InstrumentType', $instrument);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('instrument_edit', array('codeInstrument' => $instrument->getCodeinstrument()));
        }

        return $this->render('MonBundle:instrument:edit.html.twig', array(
            'instrument' => $instrument,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a instrument entity.
     *
     */
    public function deleteAction(Request $request, Instrument $instrument)
    {
        $form = $this->createDeleteForm($instrument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($instrument);
            $em->flush();
        }

        return $this->redirectToRoute('instrument_index');
    }

    /**
     * Creates a form to delete a instrument entity.
     *
     * @param Instrument $instrument The instrument entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Instrument $instrument)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('instrument_delete', array('codeInstrument' => $instrument->getCodeinstrument())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function alphabetAction($letter)
    {
      $em = $this->getDoctrine()->getManager();

      $query = $em->createQuery( //creation de la requête
        "SELECT m
        FROM MonBundle:Instrument m
        WHERE m.nomInstrument like :letter
        ORDER BY m.nomInstrument ASC")
        ->setParameter('letter', $letter.'%');
        $resultat = $query->getResult(); //variable qui récupère la requête


        return $this->render('MonBundle:instrument:alphabet.html.twig', array(
          'instruments' => $resultat,
          'letter'=> $letter,
        ));
      }
}
