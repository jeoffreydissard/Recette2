<?php

namespace HomeBundle\Controller;

use HomeBundle\Entity\Recette;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Home/index.html.twig');
    }

    public function ajoutAction(Request $request)
    {

        $user = $this->getDoctrine()
            ->getRepository('UserBundle:User')
            ->findAll();

        $recette= new Recette();
        $recette->setAuteur($this->getUser());

        $editRecette = $this->createForm('HomeBundle\Form\RecetteType', $recette);
        $editRecette->handleRequest($request);

        if ($editRecette->isSubmitted() && $editRecette->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($recette);
            $em->flush();

            return $this->redirectToRoute('home_homepage');
        }

        return $this->render('@Home/ajout.html.twig', array(
            'user' => $user,
            'recette' => $editRecette->createView(),

        ));
    }

    public function mesrecettesAction()
    {
        $recette = $this->getDoctrine()
            ->getRepository('HomeBundle:Recette')
            ->findBy(array('auteur' => $this->getUser()));


        return $this->render('@Home/mesrecettes.html.twig', array(
            'recette' => $recette,
        ));
    }

    public function recettesAction()
    {
        return $this->render('@Home/recettes.html.twig');
    }

    public function entreesAction()
    {
        $recette = $this->getDoctrine()
            ->getRepository('HomeBundle:Recette')
            ->findBy(array('categorie' => 'Entrée'));


        return $this->render('@Home/categorie.html.twig', array(
            'recette' => $recette,
        ));
    }
    public function platsAction()
    {
        $recette = $this->getDoctrine()
            ->getRepository('HomeBundle:Recette')
            ->findBy(array('categorie' => 'Plats'));


        return $this->render('@Home/categorie.html.twig', array(
            'recette' => $recette,
        ));
    }
    public function saucesAction()
    {
        $recette = $this->getDoctrine()
            ->getRepository('HomeBundle:Recette')
            ->findBy(array('categorie' => 'Sauces'));


        return $this->render('@Home/categorie.html.twig', array(
            'recette' => $recette,
        ));
    }
    public function dessertsAction()
    {
        $recette = $this->getDoctrine()
            ->getRepository('HomeBundle:Recette')
            ->findBy(array('categorie' => 'Dessert'));


        return $this->render('@Home/categorie.html.twig', array(
            'recette' => $recette,
        ));
    }

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
