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
	public function searchAction($tags)
	{
		$data = json_decode($tags);
		dump($data);
		$em = $this->getDoctrine()->getManager();
		$tags = $em->getRepository('AppBundle:Tag')->findByTag($tags);
		dump($tags);
	}

}