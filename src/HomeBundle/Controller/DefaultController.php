<?php

namespace HomeBundle\Controller;

use HomeBundle\Entity\Recette;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

    /* ============================================== Page Accueil ==============================================*/

    public function indexAction()
    {
        return $this->render('@Home/index.html.twig');
    }

    /* ============================================== Page Ajout de recette ==============================================*/

    public function ajoutAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');  // Verification pour voir si l'utilisateur est connecté sinon redirection sur /login

        $user = $this->getDoctrine()
            ->getRepository('UserBundle:User')
            ->findAll();

        $recette= new Recette();
        $recette->setAuteur($this->getUser());
        $recette->setIngredients("
1. 24 carrés de chocolat noir
2. 10 bananes
3. 40 g de beurre
4. 2 jaunes d'oeuf");
        $recette->setPreparation("
Etape 1
    Préparez la garniture :
Etape 2
    Épluchez les bananes et coupez-les en rondelles. Arrosez-les de jus de citron.
Etape 3    
    Dans une poêle, versez le miel et faites-le caraméliser à feu doux quelques instants.");
        $recette->setTemps("1 heure 24 minutes");
        $recette->setNbPersonnes("2");


        $editRecette = $this->createForm('HomeBundle\Form\RecetteType', $recette);
        $editRecette->handleRequest($request);

        if ($editRecette->isSubmitted() && $editRecette->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($recette);
            $em->flush();

            return $this->redirectToRoute('mesrecettes_homepage');
        }

        return $this->render('@Home/ajout.html.twig', array(
            'user' => $user,
            'ajoutmodif' => 'Ajouter une',
            'recette' => $editRecette->createView(),

        ));
    }

    /* ============================================== Page Modification de recette ==============================================*/

    public function modifAction($id, Request $request)
    {

        $this->denyAccessUnlessGranted('ROLE_USER');  // Verification pour voir si l'utilisateur est connecté sinon redirection sur /login

        $user = $this->getDoctrine()
            ->getRepository('UserBundle:User')
            ->findAll();

        $em = $this->getDoctrine()->getManager();
        $recettes = $em->getRepository('HomeBundle:Recette')->find($id);

        if (!$recettes) {
            throw $this->createNotFoundException(
                'Aucune recette trouvé pour cet id : '.$id
            );
        }

        if ($recettes->getAuteur() == $this->getUser()){

            $recette= new Recette();
            $recette->setAuteur($recettes->getAuteur());
            $recette->setNom($recettes->getNom());
            $recette->setCategorie($recettes->getCategorie());
            $recette->setIngredients($recettes->getIngredients());
            $recette->setPreparation($recettes->getPreparation());
            $recette->setTemps($recettes->getTemps());
            $recette->setNbPersonnes($recettes->getNbPersonnes());


            $editRecette = $this->createForm('HomeBundle\Form\RecetteType', $recette);
            $editRecette->handleRequest($request);

            if ($editRecette->isSubmitted() && $editRecette->isValid()) {
                $recettes->setAuteur($recette->getAuteur());
                $recettes->setNom($recette->getNom());
                $recettes->setCategorie($recette->getCategorie());
                $recettes->setIngredients($recette->getIngredients());
                $recettes->setPreparation($recette->getPreparation());
                $recettes->setTemps($recette->getTemps());
                $recettes->setNbPersonnes($recette->getNbPersonnes());
                $recettes->setPhoto($recette->getPhoto());
                $em = $this->getDoctrine()->getManager();
                $em->flush();

                return $this->redirectToRoute('mesrecettes_homepage');
            }

            return $this->render('@Home/ajout.html.twig', array(
                'user' => $user,
                'ajoutmodif' => 'Modifier votre',
                'recette' => $editRecette->createView(),

            ));
        } else{
            return $this->redirectToRoute('mesrecettes_homepage');
        }

    }

    /* ============================================== Supprimer une recette ==============================================*/

    public function suppAction($id)
    {

        $this->denyAccessUnlessGranted('ROLE_USER');  // Verification pour voir si l'utilisateur est connecté sinon redirection sur /login

        $recette = $this->getDoctrine()
            ->getRepository('HomeBundle:Recette')
            ->find($id);

        if ($recettes->getAuteur() == $this->getUser()){
            $manager = $this->getDoctrine()->getManager();

            $manager->remove($recette);
            $manager->flush();
            $this->addFlash('deleteRecette', 'La recette a bien étais supprimer');

            return $this->redirectToRoute('mesrecettes_homepage');
        }else{
            return $this->redirectToRoute('mesrecettes_homepage');
        }

    }

    /* ============================================== Page Mes recettes ==============================================*/

    public function mesrecettesAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');  // Verification pour voir si l'utilisateur est connecté sinon redirection sur /login

        $recette = $this->getDoctrine()
            ->getRepository('HomeBundle:Recette')
            ->findBy(array('auteur' => $this->getUser()));

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $recette, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        return $this->render('@Home/mesrecettes.html.twig', array(
            'recette' => $recette,
            'pagination' => $pagination,
        ));
    }

    /* ============================================== Page Recettes ==============================================*/

    public function recettesAction()
    {
        return $this->render('@Home/recettes.html.twig');
    }

    /* ============================================== Page Entrées ==============================================*/

    public function entreesAction(Request $request)
    {
        $recette = $this->getDoctrine()
            ->getRepository('HomeBundle:Recette')
            ->findBy(array('categorie' => 'Entrée'));

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $recette, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            6/*limit per page*/
        );

        return $this->render('@Home/categorie.html.twig', array(
            'recette' => $recette,
            'cate' => 'Les Entrées',
            'pagination' => $pagination,
        ));
    }

    /* ============================================== Page Plats ==============================================*/

    public function platsAction(Request $request)
    {
        $recette = $this->getDoctrine()
            ->getRepository('HomeBundle:Recette')
            ->findBy(array('categorie' => 'Plats'));

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $recette, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            6/*limit per page*/
        );

        return $this->render('@Home/categorie.html.twig', array(
            'recette' => $recette,
            'cate' => 'Les Plats',
            'pagination' => $pagination,
        ));
    }

    /* ============================================== Page Sauces ==============================================*/

    public function saucesAction(Request $request)
    {
        $recette = $this->getDoctrine()
            ->getRepository('HomeBundle:Recette')
            ->findBy(array('categorie' => 'Sauces'));

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $recette, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            6/*limit per page*/
        );

        return $this->render('@Home/categorie.html.twig', array(
            'recette' => $recette,
            'cate' => 'Les Sauces',
            'pagination' => $pagination,
        ));
    }

    /* ============================================== Page Desserts ==============================================*/

    public function dessertsAction(Request $request)
    {
        $recette = $this->getDoctrine()
            ->getRepository('HomeBundle:Recette')
            ->findBy(array('categorie' => 'Dessert'));

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $recette, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            6/*limit per page*/
        );

        return $this->render('@Home/categorie.html.twig', array(
            'recette' => $recette,
            'cate' => 'Les Desserts',
            'pagination' => $pagination,
        ));
    }

    /* ============================================== Page Detail de la recette ==============================================*/

    public function detailAction($id)
    {
        $recette = $this->getDoctrine()
            ->getRepository('HomeBundle:Recette')
            ->find($id);


        return $this->render('@Home/detail.html.twig', array(
            'recette' => $recette,
        ));
    }
}
