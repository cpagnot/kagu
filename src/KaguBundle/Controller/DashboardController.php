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
		$listAmbiance = $em->getRepository('AppBundle:Ambiance')->findAll();

		return $this->render('KaguBundle:Dashboard:index.html.twig');
	}
}