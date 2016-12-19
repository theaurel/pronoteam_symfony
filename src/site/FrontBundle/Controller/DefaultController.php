<?php

namespace site\FrontBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="_welcome")
     */
    public function indexAction()
    {
        
        return $this->render('siteFrontBundle:Default:index.html.twig', array('name' => 'test'));
    }
}
