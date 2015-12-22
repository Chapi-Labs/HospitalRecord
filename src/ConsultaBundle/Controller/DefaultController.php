<?php

namespace ConsultaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ConsultaBundle:Default:index.html.twig', array('name' => $name));
    }
}
