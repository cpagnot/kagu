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
use AppBundle\Repository\Tag as Repo;
use AppBundle\Form\MeubleType;
use AppBundle\Entity\Commentaire;
use Symfony\Component\HttpFoundation\JsonResponse;


class SearchController extends Controller
{
	
	public function indexAction()
	{
		return $this->render('KaguBundle:Search:index.html.twig');
	}
	
	public function searchAction($tags)
	{
		$data = json_decode($tags);
		dump($data);
		$em = $this->getDoctrine()->getManager();
		$tags = ['c'];
		$tags = $em->getRepository('AppBundle:Tag')->findBySearch($tags);
		dump($tags);
	}
	
}