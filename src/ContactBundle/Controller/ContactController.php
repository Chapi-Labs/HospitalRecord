<?php

namespace ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ContactController extends Controller
{
    /**
     * @Route("/contact",name="contact")
     *  @Template("ContactBundle:Contact:contact.html.twig")
     */
    public function indexAction()
    {
        return array('name' => 'pablo');
    }
}
