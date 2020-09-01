<?php

namespace MonBundle\Controller;

use MonBundle\Entity\Orchestres;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Orchestre controller.
 *
 */
class OrchestresController extends Controller
{
    /**
     * Lists all orchestre entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $orchestres = $em->getRepository('MonBundle:Orchestres')->findAll();

        return $this->render('MonBundle:orchestres:index.html.twig', array(
            'orchestres' => $orchestres,
        ));
    }

    /**
     * Creates a new orchestre entity.
     *
     */
    public function newAction(Request $request)
    {
        $orchestre = new Orchestre();
        $form = $this->createForm('MonBundle\Form\OrchestresType', $orchestre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($orchestre);
            $em->flush();

            return $this->redirectToRoute('orchestres_show', array('codeOrchestre' => $orchestre->getCodeorchestre()));
        }

        return $this->render('MonBundle:orchestres:new.html.twig', array(
            'orchestre' => $orchestre,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a orchestre entity.
     *
     */
    public function showAction(Orchestres $orchestre)
    {
        $deleteForm = $this->createDeleteForm($orchestre);

        return $this->render('MonBundle:orchestres:show.html.twig', array(
            'orchestre' => $orchestre,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing orchestre entity.
     *
     */
    public function editAction(Request $request, Orchestres $orchestre)
    {
        $deleteForm = $this->createDeleteForm($orchestre);
        $editForm = $this->createForm('MonBundle\Form\OrchestresType', $orchestre);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('orchestres_edit', array('codeOrchestre' => $orchestre->getCodeorchestre()));
        }

        return $this->render('MonBundle:orchestres:edit.html.twig', array(
            'orchestre' => $orchestre,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a orchestre entity.
     *
     */
    public function deleteAction(Request $request, Orchestres $orchestre)
    {
        $form = $this->createDeleteForm($orchestre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($orchestre);
            $em->flush();
        }

        return $this->redirectToRoute('orchestres_index');
    }

    /**
     * Creates a form to delete a orchestre entity.
     *
     * @param Orchestres $orchestre The orchestre entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Orchestres $orchestre)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('orchestres_delete', array('codeOrchestre' => $orchestre->getCodeorchestre())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function alphabetAction($letter)
    {
      $em = $this->getDoctrine()->getManager();
      // $musiciens = $em->getRepository('MonBundle:Musicien')->findBy([], [], 10);
      $query = $em->createQuery( //creation de la requête
        "SELECT m
        FROM MonBundle:Orchestres m
        WHERE m.nomOrchestre like :letter
        ORDER BY m.nomOrchestre ASC")
        ->setParameter('letter', $letter.'%');
        $resultat = $query->getResult(); //variable qui récupère la requête


        return $this->render('MonBundle:orchestres:alphabet.html.twig', array(
          'orchestres' => $resultat,
          'letter'=> $letter,
        ));
      }
}
