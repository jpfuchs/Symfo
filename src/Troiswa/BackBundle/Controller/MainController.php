<?php

namespace Troiswa\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
    public function DashBoardAction()
    {
        $em = $this->getDoctrine()->getManager();

        $nbFilms = $em->getRepository("TroiswaBackBundle:Film")->getNombreDeFilm();

        $meilleurFilm = $em->getRepository("TroiswaBackBundle:Film")->getMeilleurFilm();


        $nbActeurs = $em->getRepository("TroiswaBackBundle:Film")->getNombreActeur();

        $nbFilmGenre = $em->getRepository("TroiswaBackBundle:Film")->getNbFilmGenre();



        //var_dump($nbFilms, $meilleurFilm, $nbActeurs);

        $em->getRepository("TroiswaBackBundle:Film")->getFilmGenre("action");

        $em->getRepository("TroiswaBackBundle:Film")->getLastFilm(5);




        return $this->render('TroiswaBackBundle:Main:main.html.twig',["films"=>$nbFilms,
                                                                      "bestFilm"=>$meilleurFilm,
                                                                      "acteurs"=>$nbActeurs,
                                                                        "filmsGenre"=>$nbFilmGenre]);
    }




}