<?php

namespace site\BackBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use OC\UserBundle\Entity\User;

/**
 * @Route("/admin/users")
 */
class UsersController extends Controller
{
    /**
     * @Route("/", name="indexUser")
     */
    public function indexAction()
    {
        // Dans un contrôleur :

        // Pour récupérer le service UserManager du bundle
        $userManager = $this->get('fos_user.user_manager');

        // Pour récupérer la liste de tous les utilisateurs
        $users = $userManager->findUsers();

        dump($users);

        return $this->render('siteBackBundle:Users:index.html.twig', array('users' => $users));
    }
    
    /**
     * @Route("/add-edit", name="addEditUser")
     */
    public function addEditAction(Request $request)
    {
        // Dans un contrôleur :

        // Pour récupérer le service UserManager du bundle
        $userManager = $this->get('fos_user.user_manager');
        // On crée un objet Advert
        $user = $userManager->createUser();

        // On crée le FormBuilder grâce au service form factory
        $formBuilder = $this->get('form.factory')->createBuilder('form', $user);

        // On ajoute les champs de l'entité que l'on veut à notre formulaire
        $formBuilder
            ->add('username',      'text')
            ->add('email',     'email')
            ->add('password',     'password')
            ->add('save',      'submit')
        ;
        // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard

        // À partir du formBuilder, on génère le formulaire
        $form = $formBuilder->getForm();
        $form->handleRequest($request);

        // On vérifie que les valeurs entrées sont correctes
        // (Nous verrons la validation des objets en détail dans le prochain chapitre)
        if ($form->isValid()) {
            // On l'enregistre notre objet $advert dans la base de données, par exemple
            $em = $this->getDoctrine()->getManager();
            $userManager->updateUser($user, false);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

            // On redirige vers la page de visualisation de l'annonce nouvellement créée
            return $this->redirect($this->generateUrl('indexUser'));
        }
        // On passe la méthode createView() du formulaire à la vue
        // afin qu'elle puisse afficher le formulaire toute seule
        return $this->render('siteBackBundle:Users:add-edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
