<?php

namespace Troiswa\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Troiswa\BackBundle\Entity\Genre;

class GenreController extends Controller
{
    public function allAction()
    {


        //var_dump($tousLesActeurs);
        $em= $this->getDoctrine()->getManager(); //Recuperation de doctrine em = entity manager

    $tousLesGenres = $em->getRepository("TroiswaBackBundle:Genre")->findAll();

       //die (var_dump($tousLesGenres));


        return $this->render('TroiswaBackBundle:Genre:genre.html.twig',["genres"=>$tousLesGenres]);
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
        $MyGenre= $em->getRepository("TroiswaBackBundle:Genre")->find($id);

       // die(var_dump($MyGenre));

        return $this->render('TroiswaBackBundle:Genre:genre2.html.twig',["genres"=>$MyGenre]);



    }


    public function  creerAction(Request $request) // $_POST et $_GET
    {
        $nouveauGenre = new Genre();
        //$nouveauGenre->setType("essai");

        $form = $this->createFormBuilder($nouveauGenre)->add("type", "text")
                                           ->add("description","textarea")
                                            ->add("ajouter","submit")
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
                $em->persist($nouveauGenre);
                //$nouveauGenre->setType("toto");

                $em->flush(); // on registre l'objet

                $sessions = $request->getSession();
                $sessions->getFlashBag()->add("sucess_genre", "Le genre a bien été ajouté");

                return $this->redirect($this->generateUrl("troiswa_back_genre"));
            }
        //}


        return $this->render('TroiswaBackBundle:Genre:creer.html.twig',["formGenre"=>$form->createView()]);

    }


    public function  modifierAction($id, Request $request) // $_POST et $_GET
    {
       // $nouveauGenre = new Genre();

        $em = $this->getDoctrine()->getManager();
        $genre = $em->getRepository("TroiswaBackBundle:Genre")->find($id);


        $form = $this->createFormBuilder($genre)->add("type", "text")
            ->add("description","textarea")
            ->add("modifier","submit")
            ->getForm();

        $form->handleRequest($request);
        if ($form->isValid())
        {


            $em = $this->getDoctrine()->getManager(); //on surveille l'objet
          //  $em->persist($nouveauGenre);
            //$nouveauGenre->setType("toto");

            $em->flush(); // on registre l'objet

            $sessions = $request->getSession();
            $sessions->getFlashBag()->add("sucess_genre", "Le genre a bien été modifié");

            return $this->redirect($this->generateUrl("troiswa_back_genre"));
        }

        return $this->render('TroiswaBackBundle:Genre:modifier.html.twig',["formGenre"=>$form->createView()]);


    }



}