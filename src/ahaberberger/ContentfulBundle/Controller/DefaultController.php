<?php

namespace ahaberberger\ContentfulBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $cfs = $this->get('ahaberberger_contentful.contentful');

        $entries = $cfs->listEntries('2KMhvC1ExqCUkku6qcSw22');

        return $this->render('ahaberbergerContentfulBundle:Default:index.html.twig', ['entries' => $entries]);
    }
}
