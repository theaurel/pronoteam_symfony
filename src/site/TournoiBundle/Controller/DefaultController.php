<?php

namespace site\TournoiBundle\Controller;

use site\TournoiBundle\siteTournoiBundle;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use site\TournoiBundle\Form\ButeurType;
use Symfony\Component\Validator\Constraints\DateTime;

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

        $classement = $em->getRepository('OCUserBundle:User')
            ->getClassementTournoi($tournoi);

        $matchs = $em->getRepository('siteTournoiBundle:MatchTournoi')
            ->getMatchsWithUsersAndEquipes($tournoi);

        $lastMatch = $em->getRepository('siteTournoiBundle:MatchTournoi')
            ->getLastScoreMatch($tournoi);

        $date_last_update = new \DateTime();
        if($lastMatch)
            $date_last_update = $lastMatch->getDateScore();

        return $this->render('siteTournoiBundle:Default:id.html.twig', array("tournoi"=>$tournoi, "matchs"=>$matchs, "users" => $users, "classement" => $classement, "date_last_update" => $date_last_update));
    }

    /**
     * @Route("/{id_tournoi}/update", name="update")
     */
    public function updateAction(Request $request, $id_tournoi)
    {
        $return = array();
        $em = $this->getDoctrine()->getManager();

        $date_sent = $request->request->get('date_sent');

        $date_sent = new \DateTime($date_sent);
        $return["date_sent"] = $date_sent->format('Y-m-d H:i:s');

        $tournoi = $em->getRepository('siteTournoiBundle:Tournoi')
            ->find($id_tournoi);

        $lastMatch = $em->getRepository('siteTournoiBundle:MatchTournoi')
            ->getLastScoreMatch($tournoi);

        $change = 0;
        if($lastMatch){
            $return["date_last"] = $lastMatch->getDateScore()->format("Y-m-d H:i:s");
            if($lastMatch->getDateScore() > $date_sent)
                $change = 1;
        }
        $return["change"] = $change;

        if($change){
            $classement = $em->getRepository('OCUserBundle:User')
                ->getClassementTournoi($tournoi);

            $matchs = $em->getRepository('siteTournoiBundle:MatchTournoi')
                ->getMatchsWithUsersAndEquipes($tournoi);

            $return["liste_matchs"] = $this->render('siteTournoiBundle:Default:liste_matchs.html.twig', array("tournoi" => $tournoi, "matchs"=>$matchs))->getContent();
            $return["div_classement"] = $this->render('siteTournoiBundle:Default:div_classement.html.twig', array("tournoi" => $tournoi, "classement"=>$classement))->getContent();
        }

        //return $this->render('siteTournoiBundle:Default:id.html.twig', array("tournoi"=>$tournoi, "matchs"=>$matchs, "users" => $users, "date_last_update" => $date_last_update));

        return new JsonResponse($return);
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

        $match = $em->getRepository('siteTournoiBundle:MatchTournoi')
            ->find($id_match);

        if($match->getScoreDom() == null)
            $match->setScoreDom(0);
        if($match->getScoreExt() == null)
            $match->setScoreExt(0);

        $form = $this->createFormBuilder($match)
            ->setAction($this->generateUrl('score', array('id_tournoi' => $id_tournoi, 'id_match' => $id_match)))
            ->add('scoreDom', 'integer')
            ->add('scoreExt', 'integer')
            ->add('save', 'submit', array('label' => 'Fermer'))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isValid()) {
            $match->setDateScore(new \DateTime());
            $em->flush();

            $render = $this->render('siteTournoiBundle:Default:score.html.twig', array("tournoi"=>$tournoi, "match"=>$match, "form" => $form->createView()));

            return new JsonResponse(array(
                'html' => $render->getContent()
            ));
        }

        return $this->render('siteTournoiBundle:Default:score.html.twig', array("tournoi"=>$tournoi, "match"=>$match, "form" => $form->createView()));
    }
}
