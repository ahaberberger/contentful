<?php

namespace ahaberberger\ContentfulBundle\Controller;

use ahaberberger\ContentfulBundle\Entities\Link;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $cfs = $this->get('ahaberberger_contentful.contentful');

        $entries = $cfs->listEntries('2KMhvC1ExqCUkku6qcSw22');

        foreach ($entries as $entry) {
            $entry->setField('image', $cfs->resolveLink(Link::fromArray($entry->getField('image'))));
        }

        return $this->render('ahaberbergerContentfulBundle:Default:index.html.twig', ['entries' => $entries]);
    }
}
