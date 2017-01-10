<?php

namespace KaguBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller {

	/**
	*@Route("/dashboard", name="dashboard")
	*/
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

		return $this->render('KaguBundle:Dashboard:index.html.twig', array(
      		'ambiances' => $data
      ));
	}
}