<?php

namespace Troiswa\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;
use Troiswa\BackBundle\Entity\Film;


class FilmController extends Controller
{
    public function indexAction()
    {


        //var_dump($tousLesActeurs);
        $em= $this->getDoctrine()->getManager(); //Recuperation de doctrine em = entity manager
        $tousLesFilms = $em->getRepository("TroiswaBackBundle:Film")->findAll();

       //die (var_dump($tousLesFilms));

        return $this->render('TroiswaBackBundle:Film:film.html.twig',["films"=>$tousLesFilms]);
    }


    public function informationAction($id)
    {
        //  var_dump($id);

        /* $tousLesActeurs = [
             [   "id"=>1,
                 "prenom"=>"tom",
                 "nom"=>"cruise",
                 "sexe"=>0
             ],
             [   "id"=>2,
                 "prenom"=>"pascal",
                 "nom"=>"fuchs",
                 "sexe"=>0
             ],
             [   "id"=>3,
                 "prenom"=>"marine",
                 "nom"=>"guyot",
                 "sexe"=>1
             ],
         ];

         $MyActeur = [];

         foreach ($tousLesActeurs  as $key => $value)
         {
               //var_dump($value);

             if ( ($value["id"]) == intval($id) )
             {
                 $MyActeur = $value;
             }
         }*/

        $em= $this->getDoctrine()->getManager();
        $MyFilm= $em->getRepository("TroiswaBackBundle:Film")->find($id);

        //die(var_dump($MyActeur));

        return $this->render('TroiswaBackBundle:Film:film2.html.twig',["films"=>$MyFilm]);



    }

    public function  creerAction(Request $request) // $_POST et $_GET
    {
        $nouveauFilm = new Film();
        //$nouveauGenre->setType("essai");

        $form = $this->createFormBuilder($nouveauFilm)->add("titre", "text")
            ->add("description","text")
            ->add("dateDeRealisation","date")
            ->add("note","integer")
            ->add("fichier","file", ["constraints"=>new NotBlank(["message"=>"attention"])])
            ->add("laisonGenre","entity",
                [ "class"=>"TroiswaBackBundle:Genre",
                   "property"=>"type"
               ])
            ->add("valider","submit")
            ->getForm();



        //if ($request->isMethod("POST"))
        // {   //var_dump($nouveauGenre);
        // $form->submit($request);
        //die(var_dump($nouveauGenre));

        //   if ($form->isValid())
        // {
        $form->handleRequest($request);
        if ($form->isValid())
        {

            $em = $this->getDoctrine()->getManager(); //on surveille l'objet

            $nouveauFilm->upload();



            $em->persist($nouveauFilm);
            //$nouveauGenre->setType("toto");

            $em->flush(); // on registre l'objet




            $sessions = $request->getSession();

            $sessions->getFlashBag()->add("sucess_film", "Le film a bien été ajouté");

            return $this->redirect($this->generateUrl("troiswa_back_film"));
        }
        //}


        return $this->render('TroiswaBackBundle:Film:creer.html.twig',["formFilms"=>$form->createView()]);

    }


    public function  modifierAction($id, Request $request) // $_POST et $_GET
    {

        // $nouveauActeur = new Acteurs();
        //$nouveauGenre->setType("essai");

        $em = $this->getDoctrine()->getManager();
        $film = $em->getRepository("TroiswaBackBundle:Film")->find($id);

        $form = $this->createFormBuilder($film)->add("titre", "text")
            ->add("description","text")
            ->add("dateDeRealisation","date")
            ->add("note","integer")
            ->add("fichier","file", ["constraints"=>new NotBlank(["message"=>"attention"])])
            ->add("laisonGenre","entity",
                [ "class"=>"TroiswaBackBundle:Genre",
                    "property"=>"type"
                ])
            ->add("valider","submit")
            ->getForm();



        //if ($request->isMethod("POST"))
        // {   //var_dump($nouveauGenre);
        // $form->submit($request);
        //die(var_dump($nouveauGenre));

        //   if ($form->isValid())
        // {

        $form->handleRequest($request);
        if ($form->isValid())
        {


            $em = $this->getDoctrine()->getManager(); //on surveille l'objet

            //$em->persist($nouveauActeur);
            //$nouveauGenre->setType("toto");

            $em->flush(); // on registre l'objet

            $sessions = $request->getSession();

            $sessions->getFlashBag()->add("sucess_film", "Le film a bien été modifié");

            return $this->redirect($this->generateUrl("troiswa_back_film"));
        }
        //}


        return $this->render('TroiswaBackBundle:Film:modifier.html.twig',["formFilms"=>$form->createView()]);
    }







}