<?php

namespace MonBundle\Controller;

use MonBundle\Entity\Album;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Album controller.
 *
 */
class AlbumController extends Controller
{
    /**
     * Lists all album entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $albums = $em->getRepository('MonBundle:Album')->findAll();

        return $this->render('MonBundle:album:index.html.twig', array(
            'albums' => $albums,
        ));
    }

    /**
     * Creates a new album entity.
     *
     */
    public function newAction(Request $request)
    {
        $album = new Album();
        $form = $this->createForm('MonBundle\Form\AlbumType', $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($album);
            $em->flush();

            return $this->redirectToRoute('album_show', array('codeAlbum' => $album->getCodealbum()));
        }

        return $this->render('MonBundle:album:new.html.twig', array(
            'album' => $album,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a album entity.
     *
     */
    public function showAction(Album $album)
    {



      // Connexion à l'API
      $access_key_id = "AKIAJMHOT6V3K3TALJOA"; // mon code
      $secret_key = "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";
      $endpoint = "webservices.amazon.fr";
      $uri = "/onca/xml";

      // Recherche par code ASIN
      $params = array(
        "Service" => "AWSECommerceService",
        "Operation" => "ItemLookup",
        "AWSAccessKeyId" => "AKIAJMHOT6V3K3TALJOA",
        "AssociateTag" => "jmirande-21",
        "ItemId" => $album->getAsin(),  // code ASIN qui marche B014GF4492
        "IdType" => "ASIN",
        "ResponseGroup" => "Images,ItemAttributes,Offers"
      );


      if (!isset($params["Timestamp"]))
      $params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
      ksort($params);
      $pairs = array();
      foreach ($params as $key => $value)
      array_push($pairs, rawurlencode($key)."=".rawurlencode($value));
      $canonical_query_string = join("&", $pairs);
      $string_to_sign = "GET\n".$endpoint."\n".$uri."\n".$canonical_query_string;
      $signature = base64_encode(hash_hmac("sha256", $string_to_sign, $secret_key, true));
      $request_url = 'http://'.$endpoint.$uri.'?'.$canonical_query_string.'&Signature='.rawurlencode($signature);

      // Récupération du contenu XML
      $xml = simplexml_load_string(file_get_contents($request_url));

      $em = $this->getDoctrine()->getManager();

      // LEs disques
      $query2 = $em->createQuery( //creation de la requête
        "SELECT d.codeDisque,d.referenceDisque
        FROM MonBundle:Disque d
        WHERE IDENTITY(d.codeAlbum) = :codeAlbum
        ORDER BY d.referenceDisque ASC")
        ->setParameter( 'codeAlbum' , $album->getCodeAlbum());
        $disques = $query2->getResult(); //variable qui récupère la requête



        foreach($disques as &$disque)
        {
          $query3 = $em->createQuery( //creation de la requête
            "SELECT e.titre,e.duree,e.codeMorceau
            FROM MonBundle:Disque d
            INNER JOIN MonBundle:CompositionDisque cd WITH d = cd.codeDisque
            INNER JOIN MonBundle:Enregistrement e WItH e = cd.codeMorceau
            WHERE d.codeDisque = :codeDisque")
            ->setParameter( 'codeDisque' , $disque['codeDisque']);

            $enregistrements = $query3->getResult(); //variable qui récupère la requête

            $disque['enregistrements']= $enregistrements;
          }

            $enregistrements = array();


        return $this->render('MonBundle:album:show.html.twig', array(
            'album' => $album,
            'disques' => $disques,
            'enregistrements' => $enregistrements,
            'xml' => $xml,
        ));
    }

    /**
     * Displays a form to edit an existing album entity.
     *
     */
    public function editAction(Request $request, Album $album)
    {
        $deleteForm = $this->createDeleteForm($album);
        $editForm = $this->createForm('MonBundle\Form\AlbumType', $album);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('album_edit', array('codeAlbum' => $album->getCodealbum()));
        }

        return $this->render('MonBundle:album:edit.html.twig', array(
            'album' => $album,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a album entity.
     *
     */
    public function deleteAction(Request $request, Album $album)
    {
        $form = $this->createDeleteForm($album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($album);
            $em->flush();
        }

        return $this->redirectToRoute('album_index');
    }

    /**
     * Creates a form to delete a album entity.
     *
     * @param Album $album The album entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Album $album)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('album_delete', array('codeAlbum' => $album->getCodealbum())))
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
        FROM MonBundle:Album m
        WHERE m.titreAlbum like :letter
        ORDER BY m.titreAlbum ASC")
        ->setParameter('letter', $letter.'%');
        $resultat = $query->getResult(); //variable qui récupère la requête

        // foreach($musiciens as $musicien)
        // {
        //   //Genere la route
        //   $codeMusicien = $musicien->getCodeMusicien();
        //   $router = $this->container->get('router');
        //   $url = $router->generate("demo_photo", array('code' => $codeMusicien,'classe' => 'Musicien'));
        //   $musicien->setLienMusicien($url);
        // }

        return $this->render('MonBundle:album:alphabet.html.twig', array(
          'albums' => $resultat,
          'letter'=> $letter,
        ));
      }
}
