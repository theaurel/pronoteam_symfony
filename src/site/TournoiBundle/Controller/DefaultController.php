<?php

namespace site\TournoiBundle\Controller;

use site\TournoiBundle\Entity\Buteur;
use site\TournoiBundle\siteTournoiBundle;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use site\TournoiBundle\Form\ButeurType;
use Symfony\Component\Validator\Constraints\DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/tournoi")
 * @Security("has_role('ROLE_USER')")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="tournoi")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $latestVersion = $em->getRepository('siteTournoiBundle:Version')
            ->findLatest();

        $tournois = null;
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

        $classementButeurs = $em->getRepository('siteTournoiBundle:Buteur')
            ->getClassementButeurs($tournoi);

        $date_last_update = new \DateTime();
        if($lastMatch)
            $date_last_update = $lastMatch->getDateScore();

        return $this->render('siteTournoiBundle:Default:id.html.twig', array("tournoi"=>$tournoi, "matchs"=>$matchs, "users" => $users, "classement" => $classement, "date_last_update" => $date_last_update, 'classementButeurs' => $classementButeurs));
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

            $classementButeurs = $em->getRepository('siteTournoiBundle:Buteur')
                ->getClassementButeurs($tournoi);

            $return["liste_matchs"] = $this->render('siteTournoiBundle:Default:liste_matchs.html.twig', array("tournoi" => $tournoi, "matchs"=>$matchs))->getContent();
            $return["div_classement"] = $this->render('siteTournoiBundle:Default:div_classement.html.twig', array("tournoi" => $tournoi, "classement"=>$classement))->getContent();
            $return["liste_buteurs"] = $this->render('siteTournoiBundle:Default:liste_buteurs.html.twig', array("tournoi" => $tournoi, "classementButeurs"=>$classementButeurs))->getContent();
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

        $equipeDom = $match->getEquipeDom();
        $equipeExt = $match->getEquipeExt();

        $ButeurRepository = $em->getRepository('siteTournoiBundle:Buteur');
        $buteursDomicile = $ButeurRepository->getButeurs($match,$equipeDom);
        $buteursExterieur = $ButeurRepository->getButeurs($match,$equipeExt);
        $listButeursDomicile = $ButeurRepository->getListButeurs($equipeDom);
        $listButeursExterieur = $ButeurRepository->getListButeurs($equipeExt);

        $valuesDom = array();
        if($buteursDomicile){
            foreach($buteursDomicile as $buteur){
                $valuesDom[] = $buteur->getName();
            }
        }
        for ($i = count($valuesDom) ; $i <= 15 ; $i++){
            $valuesDom[] = null;
        }
        $valuesExt = array();
        if($buteursExterieur){
            foreach($buteursExterieur as $buteur){
                $valuesExt[] = $buteur->getName();
            }
        }
        for ($i = count($valuesExt) ; $i <= 15 ; $i++){
            $valuesExt[] = null;
        }
        $selectDom = array();
        if($listButeursDomicile){
            foreach($listButeursDomicile as $buteur){
                $selectDom[$buteur->getName()] = $buteur->getName();
            }
        }
        $selectExt = array();
        if($listButeursExterieur){
            foreach($listButeursExterieur as $buteur){
                $selectExt[$buteur->getName()] = $buteur->getName();
            }
        }

        $parameters = array(
            "tournoi"=>$tournoi,
            "selectDom"=>$selectDom,
            "selectExt"=>$selectExt,
            "valuesDom"=>$valuesDom,
            "valuesExt"=>$valuesExt,
            "match"=>$match,
            "form" => $form->createView()
        );

        $form->handleRequest($request);
        if ($form->isValid()) {
            foreach($buteursDomicile as $buteur){
                $em->remove($buteur);
            }
            unset($buteur);
            foreach($buteursExterieur as $buteur){
                $em->remove($buteur);
            }
            unset($buteur);
            $postbuteurs = $request->request->get('buteurs');
            foreach($postbuteurs as $id_equipe => $buteurs){
                $equipe = $id_equipe == $equipeDom->getId() ? $equipeDom : $equipeExt;
                foreach($buteurs as $buteur){
                    $new = new Buteur();
                    $new->setEquipe($equipe);
                    $new->setMatchTournoi($match);
                    $new->setName($buteur);
                    $em->persist($new);
                }
            }

            $match->setDateScore(new \DateTime());
            $em->flush();

            $render = $this->render('siteTournoiBundle:Default:score.html.twig', $parameters);

            return new JsonResponse(array(
                'data' => $form->getData(),
                //'html' => $render->getContent()
            ));
        }

        return $this->render('siteTournoiBundle:Default:score.html.twig', $parameters);
    }
}
