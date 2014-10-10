<?php

namespace ahaberberger\LayoutBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ahaberbergerLayoutBundle:Default:index.html.twig', array('name' => $name));
    }
}
