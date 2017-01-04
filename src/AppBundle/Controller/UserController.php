<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;


class UserController extends Controller
{
	/**
     * @Route("/inscription", name="inscription")
     */
	public function createUserAction(Request $request)
	{
		$user = new User();

		$formBuilder = $this->get('form.factory')->createBuilder('form', $user);

		$formBuilder
	      ->add('name',      		'text')
	      ->add('firstname', 		'text')
	      ->add('mail',   	 		'text')
	      ->add('pseudo',    		'text')
	      ->add('password',  		'password')
	      ->add('ville',			'text')
	      ->add('cp',				'text')
	      ->add('birthday',			'date')
	      ->add('adresse',			'text')
	      ->add('submit',			'submit');

       $form = $formBuilder->getForm();

       $form->handleRequest($request);

       if($form->isValid())
       {
       		$user->setDateInscription(new \DateTime());
       		$user->setPassword(md5($user->getPassword()));
       		$em = $this->getDoctrine()->getManager();
      		$em->persist($user);
      		$em->flush();

      		$request->getSession()->getFlashBag()->add('notice', 'Inscription valide.');

      		return $this->redirect($this->generateUrl('homepage'));

       }



		return $this->render('AppBundle:User:inscription.html.twig', array(
			'form' => $form->createView(),
			'test' => 'test'	
			)
		);

	}
}