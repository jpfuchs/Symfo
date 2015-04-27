<?php

namespace Troiswa\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;
use Troiswa\BackBundle\Entity\Acteurs;

class ActeurController extends Controller
{
    public function indexAction()
    {
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
        ];*/

        //var_dump($tousLesActeurs);
        $em= $this->getDoctrine()->getManager(); //Recuperation de doctrine em = entity manager
        $tousLesActeurs = $em->getRepository("TroiswaBackBundle:Acteurs")->findAll();

       // die (var_dump($tousLesActeurs));





        return $this->render('TroiswaBackBundle:Acteur:acteur.html.twig',["acteurs"=>$tousLesActeurs]);
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
        $MyActeur= $em->getRepository("TroiswaBackBundle:Acteurs")->find($id);

        if (empty($MyActeur))
        {
            throw $this->createNotFoundException("cette acteur n'existe pas");
        }

        //die(var_dump($MyActeur));

        return $this->render('TroiswaBackBundle:Acteur:acteur2.html.twig',["acteurs"=>$MyActeur]);



    }


    public function  creerAction(Request $request) // $_POST et $_GET
    {
        $nouveauActeur = new Acteurs();
        //$nouveauGenre->setType("essai");

        $form = $this->createFormBuilder($nouveauActeur)->add("prenom", "text")
            ->add('sexe', 'choice', array(
                'choices'   => array('0' => 'Masculin', '1' => 'Féminin'),
                'expanded'  => true,
            ))->add("nom","text")
            ->add("dateNaissance","date")
            ->add("ville","text")
            ->add("liaisonFilms","entity",
                [ "class"=>"TroiswaBackBundle:Film",
                    "property"=>"titre",
                    "multiple"=>true
                ])
            ->add("biographie","text")
            ->add("fichier","file", ["constraints"=>new NotBlank(["message"=>"attention"])])
            ->add("valider","submit")
            ->getForm();

        ;

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

            $nouveauActeur->upload();



            $em->persist($nouveauActeur);
            //$nouveauGenre->setType("toto");

            $em->flush(); // on registre l'objet




            $sessions = $request->getSession();

            $sessions->getFlashBag()->add("sucess_acteur", "L'acteur a bien été ajouté");

            return $this->redirect($this->generateUrl("troiswa_back_acteur"));
        }
        //}


        return $this->render('TroiswaBackBundle:Acteur:creer.html.twig',["formActeurs"=>$form->createView()]);

    }

    public function  modifierAction($id, Request $request) // $_POST et $_GET
    {

      // $nouveauActeur = new Acteurs();
        //$nouveauGenre->setType("essai");

        $em = $this->getDoctrine()->getManager();
        $acteur = $em->getRepository("TroiswaBackBundle:Acteurs")->find($id);

        $form = $this->createFormBuilder($acteur)->add("prenom", "text")
            ->add('sexe', 'choice', array(
                'choices'   => array('0' => 'Masculin', '1' => 'Féminin'),
                'expanded'  => true,
            ))->add("nom","text")
            ->add("dateNaissance","date")
            ->add("ville","text")
            ->add("biographie","text")
            ->add("image","text")
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

            $sessions->getFlashBag()->add("sucess_acteur", "L'acteur a bien été modifié");

            return $this->redirect($this->generateUrl("troiswa_back_acteur"));
        }
        //}


        return $this->render('TroiswaBackBundle:Acteur:modifier.html.twig',["formActeurs"=>$form->createView()]);
    }


    public function  supprimerAction($id, Request $request) // $_POST et $_GET
    {

            $em = $this->getDoctrine()->getManager(); //on surveille l'objet
            $acteur = $em->getRepository("TroiswaBackBundle:Acteurs")->find($id);
            $em->remove($acteur);
            $em->flush(); // on registre l'objet

            $sessions = $request->getSession();
            $sessions->getFlashBag()->add("supp_acteur", "L'acteur a bien été supprimé");

        return $this->redirect($this->generateUrl("troiswa_back_acteur"));
            //return $this->render('TroiswaBackBundle:Acteur:supprimer.html.twig',["formActeurs"=>$form->createView()]);
    }


}