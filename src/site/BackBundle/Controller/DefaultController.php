<?php

namespace site\BackBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/adminmanuel")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        // Dans un contrôleur :

        return $this->render('siteBackBundle:Default:index.html.twig', array());
    }
}
