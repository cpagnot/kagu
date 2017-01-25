<?php

namespace KaguBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Wishlist;

class UtilsController extends Controller {

	public function uploadImageAction(Request $request)
    {
    	$file = $request->files->get('upload');
    	$status = array('status' => "success","fileUploaded" => false);
  
	   // If a file was uploaded
	   if(!is_null($file)){
	      // generate a random name for the file but keep the extension
	      $filename = uniqid().".".$file->getClientOriginalExtension();
	      $path = $this->container->getParameter('kernel.root_dir').'/../web/img/ambiance/';
	      $file->move($path,$filename); // move the file to a path
	      $status = array('status' => "success","fileUploaded" => true, "filename" => $filename);
	   }

	   return new JsonResponse($status);
	}
	
	public function addWishlistAction($ambiance)
	{
		$user = $this->get('security.token_storage')->getToken()->getUser();
		$em = $this->getDoctrine()->getManager();
		$ambiance = $em->getRepository('AppBundle:Ambiance')->find($ambiance);
		$wishExist = $em->getRepository('AppBundle:Wishlist')->findOneBy(
			array(
				'user' => $user,
				'ambiance' => $ambiance
			)
		);
		
		if($wishExist){
			$em->remove($wishExist);
			$status = array('action' => 'delete', 'result' => true);
		}else{
			$wish = new Wishlist();
			$wish->setUser($user);
			$wish->setAmbiance($ambiance);
			$em->persist($wish);
			$status = array('action' => 'add', 'result' => true);
		}
		
		$em->flush();
		
		return new JsonResponse($status);
	}
	
}
