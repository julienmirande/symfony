<?php

namespace MonBundle\Controller;

use MonBundle\Entity\Musicien;
use MonBundle\Entity\Disque;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
* Musicien controller.
*
*/
class MusicienController extends Controller
{

  public function enregistrementAction($codeAlbum)
  {
    //Pour les $oeuvres
    $em = $this->getDoctrine()->getManager();

    $query1 = $em->createQuery( //creation de la requête
      "SELECT a.titreAlbum,a.codeAlbum,a.pochette,a.asin
      FROM MonBundle:Album a
      WHERE a.codeAlbum like :codeAlbum
      ORDER BY a.titreAlbum ASC")
      ->setParameter( 'codeAlbum' , $codeAlbum);
      $albums = $query1->getResult(); //variable qui récupère la requête


      //Pour l'API AMAZONE

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
        "ItemId" => $albums[0]['asin'],  // code ASIN qui marche B014GF4492
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


      // LEs disques

      $query2 = $em->createQuery( //creation de la requête
        "SELECT d.codeDisque,d.referenceDisque
        FROM MonBundle:Disque d
        WHERE IDENTITY(d.codeAlbum) = :codeAlbum
        ORDER BY d.referenceDisque ASC")
        ->setParameter( 'codeAlbum' , $codeAlbum);
        $disques = $query2->getResult(); //variable qui récupère la requête



        foreach($disques as &$disque)
        {
          $query3 = $em->createQuery( //creation de la requête
            "SELECT e.titre,e.duree,e.codeMorceau
            FROM MonBundle:Disque d
            INNER JOIN MonBundle:CompositionDisque cd WITH d = cd.codeDisque
            INNER JOIN MonBundle:Enregistrement e WItH e = cd.codeMorceau
            WHERE d.codeDisque = :codeDisque")
            ->setParameter( 'codeDisque' , $disque['codeDisque'])
            ->setMaxResults(10);

            $enregistrements = $query3->getResult(); //variable qui récupère la requête

            $disque['enregistrements']= $enregistrements;
          }


          return $this->render('MonBundle:album:show.html.twig', array(
            'album' => $albums[0],
            'disques' => $disques,
            'enregistrements' => $enregistrements,
            'xml' => $xml,
          ));
        }

        public function photoAction($code, $classe) {
          $inst = $this->getDoctrine()
          ->getRepository('MonBundle:' . $classe)
          ->find($code);
          $image = stream_get_contents($inst->getImage());
          $image = pack("H*", $image);
          $response = new \Symfony\Component\HttpFoundation\Response();
          $response->headers->set('Content-type', 'image/jpeg');
          $response->headers->set('Content-Transfer-Encoding', 'binary');
          $response->setContent($image);
          return $response;
        }

        public function sonAction($codeMorceau, $classe) {
          $inst = $this->getDoctrine()
          ->getRepository('MonBundle:' . $classe)
          ->find($codeMorceau);
          $son = stream_get_contents($inst->getExtrait());
          $son = pack("H*", $son);
          $response = new \Symfony\Component\HttpFoundation\Response();
          $response->headers->set('Content-type', 'audio/mpeg');
          $response->headers->set('Content-Transfer-Encoding', 'binary');
          $response->setContent($son);
          return $response;
        }

        /**
        * Lists all musicien entities.
        *
        */
        public function indexAction()
        {
          $em = $this->getDoctrine()->getManager();

          // $resultat = $em->getRepository('MonBundle:Musicien')->findBy([], [], 10);
          $query = $em->createQuery( //creation de la requête
            "SELECT  m
            FROM MonBundle:Musicien m
            INNER JOIN MonBundle:Composer c WITH m = c.codeMusicien
            ORDER BY m.nomMusicien ASC
            ");
            $resultat = $query->getResult(); //variable qui récupère la requête

            return $this->render('MonBundle:musicien:index.html.twig', array(
              'musiciens' => $resultat,
            ));
          }

          /**
          * Lists musicien beggining by letter.
          *
          */
          public function alphabetAction($letter)
          {
            $em = $this->getDoctrine()->getManager();
            // $musiciens = $em->getRepository('MonBundle:Musicien')->findBy([], [], 10);
            $query = $em->createQuery( //creation de la requête
              "SELECT m
              FROM MonBundle:Musicien m
              INNER JOIN MonBundle:Composer c WITH m = c.codeMusicien
              WHERE m.nomMusicien like :letter
              ORDER BY m.nomMusicien ASC")
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

              return $this->render('MonBundle:musicien:alphabet.html.twig', array(
                'musiciens' => $resultat,
                'letter'=> $letter,
              ));
            }

            /**
            * Creates a new musicien entity.
            *
            */
            public function newAction(Request $request)
            {
              $musicien = new Musicien();
              $form = $this->createForm('MonBundle\Form\MusicienType', $musicien);
              $form->handleRequest($request);

              if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($musicien);
                $em->flush();

                return $this->redirectToRoute('musicien_show', array('codeMusicien' => $musicien->getCodemusicien()));
              }

              return $this->render('MonBundle:musicien:new.html.twig', array(
                'musicien' => $musicien,
                'form' => $form->createView(),
              ));
            }

            /**
            * Finds and displays a musicien entity.
            *
            */
            public function showAction(Musicien $musicien)
            {

              //Pour les $oeuvres
              $em = $this->getDoctrine()->getManager();


              $qbd = $em->createQueryBuilder('a');
              $qbd->select('a')
              ->from('MonBundle:Album', 'a')
              ->innerJoin('MonBundle:Disque', 'd', 'WITH', 'd.codeAlbum = a.codeAlbum')
              ->innerJoin('MonBundle:CompositionDisque', 'cd', 'WITH', 'cd.codeDisque = d.codeDisque')
              ->innerJoin('MonBundle:Enregistrement', 'e', 'WITH', 'e.codeMorceau = cd.codeMorceau')
              ->innerJoin('MonBundle:CompositionOeuvre', 'co', 'WITH', 'co.codeComposition = e.codeComposition')
              ->innerJoin('MonBundle:Composer', 'c', 'WITH', 'c.codeOeuvre = co.codeOeuvre')
              ->where('c.codeMusicien = :codeM' )
              ->setParameter('codeM',$musicien->getCodeMusicien())
              ->add('orderBy', 'a.titreAlbum ASC');
              $albums = $qbd->getQuery()->getResult();



              return $this->render('MonBundle:musicien:show.html.twig', array(
                'musicien' => $musicien,
                'oeuvres' => $albums,
              ));
            }

            /**
            * Displays a form to edit an existing musicien entity.
            *
            */
            public function editAction(Request $request, Musicien $musicien)
            {
              $deleteForm = $this->createDeleteForm($musicien);
              $editForm = $this->createForm('MonBundle\Form\MusicienType', $musicien);
              $editForm->handleRequest($request);

              if ($editForm->isSubmitted() && $editForm->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('musicien_edit', array('codeMusicien' => $musicien->getCodemusicien()));
              }

              return $this->render('MonBundle:musicien:edit.html.twig', array(
                'musicien' => $musicien,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
              ));
            }

            /**
            * Deletes a musicien entity.
            *
            */
            public function deleteAction(Request $request, Musicien $musicien)
            {
              $form = $this->createDeleteForm($musicien);
              $form->handleRequest($request);

              if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($musicien);
                $em->flush();
              }

              return $this->redirectToRoute('musicien_index');
            }

            /**
            * Creates a form to delete a musicien entity.
            *
            * @param Musicien $musicien The musicien entity
            *
            * @return \Symfony\Component\Form\Form The form
            */
            private function createDeleteForm(Musicien $musicien)
            {
              return $this->createFormBuilder()
              ->setAction($this->generateUrl('musicien_delete', array('codeMusicien' => $musicien->getCodemusicien())))
              ->setMethod('DELETE')
              ->getForm()
              ;
            }
          }
