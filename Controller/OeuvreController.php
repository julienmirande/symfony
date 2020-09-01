<?php

namespace MonBundle\Controller;

use MonBundle\Entity\Oeuvre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Oeuvre controller.
 *
 */
class OeuvreController extends Controller
{
    /**
     * Lists all oeuvre entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $oeuvres = $em->getRepository('MonBundle:Oeuvre')->findAll();

        return $this->render('MonBundle:oeuvre:index.html.twig', array(
            'oeuvres' => $oeuvres,
        ));
    }

    /**
     * Creates a new oeuvre entity.
     *
     */
    public function newAction(Request $request)
    {
        $oeuvre = new Oeuvre();
        $form = $this->createForm('MonBundle\Form\OeuvreType', $oeuvre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($oeuvre);
            $em->flush();

            return $this->redirectToRoute('oeuvre_show', array('codeOeuvre' => $oeuvre->getCodeoeuvre()));
        }

        return $this->render('MonBundle:oeuvre:new.html.twig', array(
            'oeuvre' => $oeuvre,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a oeuvre entity.
     *
     */
    public function showAction(Oeuvre $oeuvre)
    {
        $deleteForm = $this->createDeleteForm($oeuvre);

        return $this->render('MonBundle:oeuvre:show.html.twig', array(
            'oeuvre' => $oeuvre,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing oeuvre entity.
     *
     */
    public function editAction(Request $request, Oeuvre $oeuvre)
    {
        $deleteForm = $this->createDeleteForm($oeuvre);
        $editForm = $this->createForm('MonBundle\Form\OeuvreType', $oeuvre);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('oeuvre_edit', array('codeOeuvre' => $oeuvre->getCodeoeuvre()));
        }

        return $this->render('MonBundle:oeuvre:edit.html.twig', array(
            'oeuvre' => $oeuvre,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a oeuvre entity.
     *
     */
    public function deleteAction(Request $request, Oeuvre $oeuvre)
    {
        $form = $this->createDeleteForm($oeuvre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($oeuvre);
            $em->flush();
        }

        return $this->redirectToRoute('oeuvre_index');
    }

    /**
     * Creates a form to delete a oeuvre entity.
     *
     * @param Oeuvre $oeuvre The oeuvre entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Oeuvre $oeuvre)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('oeuvre_delete', array('codeOeuvre' => $oeuvre->getCodeoeuvre())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
