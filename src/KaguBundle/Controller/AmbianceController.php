<?php

namespace KaguBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Ambiance;
use AppBundle\Form\AmbianceType;
use AppBundle\Entity\Meuble;
use AppBundle\Entity\Tag;
use AppBundle\Form\MeubleType;
use AppBundle\Entity\Commentaire;
use Symfony\Component\HttpFoundation\JsonResponse;

class AmbianceController extends Controller
{

  public function indexAction()
  {
    $em = $this->getDoctrine()->getManager();
    $listAmbiance = $em->getRepository('AppBundle:Ambiance')
      ->findBy(array('designer' => $this->get('security.token_storage')->getToken()->getUser()->getId() ));

    $data = array();

    foreach ($listAmbiance as $ambiance) {
      $data[$ambiance->getId()] = array();
      $data[$ambiance->getId()]['annonce'] = $ambiance;
      $objets = $em->getRepository('AppBundle:Meuble')->findBy(array('annonce' => $ambiance->getId()));
      $data[$ambiance->getId()]['objets'] = $objets;
    }

    return $this->render('KaguBundle:Ambiance:index.html.twig', array(
          'ambiances' => $data
      ));
  }

	/**
     * @Route("/add", name="ambiance")
     */
    public function addAction(Request $request)
    {
    	$ambiance = new Ambiance();
    	$form = $this->get('form.factory')->create(new AmbianceType, $ambiance);

    	if ($form->handleRequest($request)->isValid()) {
    		$ambiance->setDesigner($this->get('security.token_storage')->getToken()->getUser());
    		$ambiance->setPublic(false);
    		$ambiance->setDisponible(true);
    		$ambiance->setVendu(false);
      		$em = $this->getDoctrine()->getManager();
      		$em->persist($ambiance);
      		$em->flush();
      		$request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

      		return $this->redirect($this->generateUrl('kagu_index_ambiance'));
    	}
  
        return $this->render('KaguBundle:Ambiance:add.html.twig', array(
      		'form' => $form->createView()
      ));
    }

    public function addExecAction($data)
    {
        $em = $this->getDoctrine()->getManager();

        $data = json_decode($data, true);
        $ambiance = new Ambiance();
        $ambiance->setTitre($data['title']);
        $ambiance->setDescription($data['description']);
        $ambiance->setDateCreation(new \DateTime());
        $ambiance->setPublic(false);
        $ambiance->setDisponible(true);
        $ambiance->setVendu(false);
        $ambiance->setPhoto($data['img']);
        $ambiance->setDesigner($this->get('security.token_storage')->getToken()->getUser());
        $em->persist($ambiance);
        foreach ($data['tags'] as $tag) {
           $obj = new Meuble();
           $obj->setX($tag['x']);
           $obj->setY($tag['y']);
           $obj->setTitre($tag['titre']);
           $obj->setPrix($tag['prix']);
           $obj->setDescription($tag['description']);
           $obj->setAnnonce($ambiance);

           $em->persist($obj);
        }
        $em->flush();
        return new JsonResponse(array('response' => true));
    }

    public function deleteAction($ambiance)
    {
      $em = $this->getDoctrine()->getManager();
      $ambianceRepo = $em->getRepository('AppBundle:Ambiance');
      $ambiance = $ambianceRepo->find($ambiance);
      try {
        $em->remove($ambiance);
        $em->flush();        
      }catch(Exception $e){
        dump($e);
      }

      return $this->redirect($this->generateUrl('kagu_index_ambiance'));


    }

    public function publishAction($ambiance)
    {
      $em = $this->getDoctrine()->getManager();
      $ambianceRepo = $em->getRepository('AppBundle:Ambiance');
      $ambiance = $ambianceRepo->find($ambiance);
      $ambiance->setPublic(!$ambiance->getPublic());
      try {
        $em->persist($ambiance);
        $em->flush();        
      }catch(Exception $e){
        dump($e);
      }

      return $this->redirect($this->generateUrl('kagu_index_ambiance'));
    }

    public function editAction(Request $request, $ambiance)
    {
      $em = $this->getDoctrine()->getManager();
      $ambianceRepo = $em->getRepository('AppBundle:Ambiance');
      $ambiance = $ambianceRepo->find($ambiance);

      $meubleRepo = $em->getRepository('AppBundle:Meuble');
      $meubles = $meubleRepo->findBy(array('annonce' => $ambiance));

     
      return $this->render('KaguBundle:Ambiance:add.html.twig', array(
          'ambiance' => $ambiance,
          'meubles'  => $meubles
      ));

    }

    public function editExecAction($data, $ambiance)
    {
        $em = $this->getDoctrine()->getManager();
        
        $ambiance = $em->getRepository('AppBundle:Ambiance')->find($ambiance);
        $meubles = $em->getRepository('AppBundle:Meuble')->findBy(array('annonce' => $ambiance  ));
        foreach ($meubles as $meuble) {
          $em->remove($meuble);
        }

        $data = json_decode($data, true);

        dump($data);

        foreach ($data['tags'] as $tag) {
           $obj = new Meuble();
           $obj->setX($tag['x']);
           $obj->setY($tag['y']);
           $obj->setTitre($tag['titre']);
           $obj->setPrix($tag['prix']);
           $obj->setDescription($tag['description']);
           $obj->setAnnonce($ambiance);

           $em->persist($obj);
        }

        $em->flush();
        return new JsonResponse(array('response' => true));
    }

    public function ambianceAction($ambiance)
    {
      $em = $this->getDoctrine()->getManager();
      $ambiance = $em->getRepository('AppBundle:Ambiance')->find($ambiance);
      $meuble = $em->getRepository('AppBundle:Meuble')->findBy(array('annonce' => $ambiance ));
      $tag = $em->getRepository('AppBundle:Tag')->findBy(array('ambiance' => $ambiance));
      $commentaires = $em->getRepository('AppBundle:Commentaire')->findBy(array('annonce' => $ambiance));

      return $this->render('KaguBundle:Ambiance:ambiance.html.twig', array(
        'ambiance'      => $ambiance,
        'meubles'       => $meuble,
        'tags'          => $tag,
        'commentaires'  => $commentaires
      ));
    }

    public function addCommentAction($id, $comment)
    {

      $em = $this->getDoctrine()->getManager();

      $com = new Commentaire();
      $com->setUser($this->get('security.token_storage')->getToken()->getUser());
      $com->setAnnonce($em->getRepository('AppBundle:Ambiance')->find($id));
      $com->setCommentaire($comment);
      $com->setDate(new \DateTime());

      $em->persist($com);
      $em->flush();

      return new JsonResponse(array('comment' => $com ));
    }

}