<?php

namespace site\TournoiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/tournoi")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $latestVersion = $this->getDoctrine()
            ->getRepository('siteTournoiBundle:Version')
            ->findLatest();

        if($latestVersion){
            $tournois = $latestVersion->getTournois();

        }

        return $this->render('siteTournoiBundle:Default:index.html.twig', array('tournois' => $tournois));
    }

    /**
     * @Route("/{id_tournoi}", name="tournoiid")
     */
    public function idAction($id_tournoi)
    {
        $tournoi = $this->getDoctrine()
            ->getRepository('siteTournoiBundle:Tournoi')
            ->find($id_tournoi);

        $users = $this->getDoctrine()
            ->getRepository('siteTournoiBundle:TournoiUser')
            ->findByTournoi($tournoi);

        $array_equipe = array();
        foreach($users as $user){
            $array_equipe[$user->getUser()->getId()] = $user->getEquipe();
        }

        $matchs = $tournoi->getMatchs();

        return $this->render('siteTournoiBundle:Default:id.html.twig', array("matchs"=>$matchs, "array_equipe" => $array_equipe));
    }
}
