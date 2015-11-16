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

        $userManager = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:User');

        // Pour charger un utilisateur
        $user = $userManager->findBy(array('username' => 'aurel'));

        // Pour supprimer un utilisateur
        //$userManager->deleteUser($user);

        // Pour r�cup�rer la liste de tous les utilisateurs
        //$users = $userManager->findUsers();
        return $this->render('siteFrontBundle:Default:index.html.twig', array('name' => 'test'));
    }
}
