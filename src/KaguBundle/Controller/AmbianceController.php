<?php

namespace KaguBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Ambiance;
use AppBundle\Form\AmbianceType;
use AppBundle\Entity\Meuble;
use AppBundle\Form\MeubleType;

class AmbianceController extends Controller
{
	/**
     * @Route("/index", name="ambiance")
     */
    public function indexAction(Request $request)
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

      		return $this->redirect($this->generateUrl('kagu_homepage'));
    	}
  
        return $this->render('KaguBundle:Ambiance:index.html.twig', array(
      		'form' => $form->createView()
      ));
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

      return $this->redirect($this->generateUrl('kagu_homepage'));


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

      return $this->redirect($this->generateUrl('kagu_homepage'));
    }

    public function editAction(Request $request, $ambiance)
    {
      $em = $this->getDoctrine()->getManager();
      $ambianceRepo = $em->getRepository('AppBundle:Ambiance');
      $ambiance = $ambianceRepo->find($ambiance);
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

          return $this->redirect($this->generateUrl('kagu_homepage'));
      }
  
        return $this->render('KaguBundle:Ambiance:index.html.twig', array(
          'form' => $form->createView()
      ));

    }

    public function addItemAction(Request $request, $ambiance)
    {

      $meuble = new Meuble();
      $form = $this->get('form.factory')->create(new MeubleType, $meuble);

      if ($form->handleRequest($request)->isValid()) {
          $em = $this->getDoctrine()->getManager(); 
          $meuble->setAnnonce($em->getRepository('AppBundle:Ambiance')->find($ambiance));
          $em->persist($meuble);
          $em->flush();
          $request->getSession()->getFlashBag()->add('notice', 'Meuble bien ajouté.');

          return $this->redirect($this->generateUrl('kagu_homepage'));
      }
  
        return $this->render('KaguBundle:Meuble:add.html.twig', array(
          'form' => $form->createView()
      ));

    }

}