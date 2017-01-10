<?php

namespace KaguBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('KaguBundle:Default:index.html.twig', array('name' => $name));
    }
}
