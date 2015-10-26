<?php

namespace site\TournoiBundle\Controller;

use site\TournoiBundle\siteTournoiBundle;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use site\TournoiBundle\Form\ButeurType;

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
        $em = $this->getDoctrine()->getManager();
        $latestVersion = $em->getRepository('siteTournoiBundle:Version')
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
        $em = $this->getDoctrine()->getManager();
        $tournoi = $em->getRepository('siteTournoiBundle:Tournoi')
            ->find($id_tournoi);

        $users = $em->getRepository('siteTournoiBundle:TournoiUser')
            ->findByTournoiWithEquipes($tournoi);

        $array_equipe = array();
        foreach($users as $user){
            $array_equipe[$user->getUser()->getId()] = $user->getEquipe();
        }

        $matchs = $em->getRepository('siteTournoiBundle:MatchTournoi')
            ->getMatchsWithUsers($tournoi);

        return $this->render('siteTournoiBundle:Default:id.html.twig', array("tournoi"=>$tournoi, "matchs"=>$matchs, "array_equipe" => $array_equipe));
    }


    /**
     * @Route("/{id_tournoi}/match/{id_match}", name="score")
     */
    public function scoreAction(Request $request, $id_tournoi, $id_match){
        $em = $this->getDoctrine()->getManager();
        $tournoi = $em->getRepository('siteTournoiBundle:Tournoi')
            ->find($id_tournoi);

        $users = $em->getRepository('siteTournoiBundle:TournoiUser')
            ->findByTournoi($tournoi);

        $array_equipe = array();
        foreach($users as $user){
            $array_equipe[$user->getUser()->getId()] = $user->getEquipe();
        }

        $match = $em->getRepository('siteTournoiBundle:MatchTournoi')
            ->find($id_match);

        $form = $this->createFormBuilder($match)
            ->setAction($this->generateUrl('score', array('id_tournoi' => $id_tournoi, 'id_match' => $id_match)))
            ->add('scoreDom', 'text')
            ->add('scoreExt', 'text')
            ->add('buteurs', 'collection', array(
                'type'         => new ButeurType(),
                'allow_add'    => false,
                'allow_delete' => false
            ))
            ->add('save', 'submit', array('label' => 'Enregistrer score'))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tournoiid', array('id_tournoi' => $id_tournoi)));
        }

        return $this->render('siteTournoiBundle:Default:score.html.twig', array("tournoi"=>$tournoi, "match"=>$match, "array_equipe" => $array_equipe, "form" => $form->createView()));
    }
}
