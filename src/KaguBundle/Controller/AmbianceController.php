<?php

namespace KaguBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Ambiance;
use AppBundle\Form\AmbianceType;

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

      		return $this->redirect($this->generateUrl('ambiance'));
    	}
  
        return $this->render('KaguBundle:Ambiance:index.html.twig', array(
      		'form' => $form->createView()
      ));
    }
}