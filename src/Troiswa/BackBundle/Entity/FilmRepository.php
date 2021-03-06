<?php

namespace Troiswa\BackBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * FilmRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FilmRepository extends EntityRepository
{

    public function getNombreDeFilm()
    {
        $query = $this->getEntityManager()->createQuery(
            "SELECT count(f) from TroiswaBackBundle:Film f"

        );

        //die(var_dump($query->getSingleScalarResult()));

        return $query->getSingleScalarResult();
    }


    public function getMeilleurFilm()
    {
        $query = $this->getEntityManager()->createQuery(
        "SELECT f FROM  TroiswaBackBundle:Film f ORDER BY f.note DESC "

        );

        //var_dump($query->setMaxResults(1)->getSingleResult());
        return $query->setMaxResults(1)->getSingleResult();

    }

    public function getNombreActeur()
    {
        $query = $this->getEntityManager()->createQuery(
            "SELECT count(f) from TroiswaBackBundle:Acteurs f"

        );

        //die(var_dump($query->getSingleScalarResult()));

        return $query->getSingleScalarResult();
    }

    //aide memoire:
    //getResult == fetchAll()
    //getSingleResult == fetch()
   //getSingleScalarResult() ==fetchColumn()

    public function getNbFilmGenre()
    {
        $query = $this->getEntityManager()->createQuery(
            "SELECT count(f), g.type FROM  TroiswaBackBundle:Film f JOIN f.laisonGenre g  GROUP BY f.laisonGenre"

        );

     // equivalent en sql  SELECT COUNT( * ) , Genre.type
      //  FROM film
//JOIN Genre ON Genre.id = film.laisonGenre_id
//GROUP BY Genre.type

       // var_dump($query->getResult());

// !!! reste a l'afficher dans la vue !!!!!!
        return $query->getResult();

    }


    public function getFilmGenre($type)
    {
        $query = $this->getEntityManager()->createQuery(
            "SELECT f  FROM  TroiswaBackBundle:Film f JOIN f.laisonGenre g  WHERE g.type = :letype"

        );

       $query->setParameter("letype", $type)->getResult();

        // equivalent en sql  SELECT COUNT( * ) , Genre.type
        //  FROM film
//JOIN Genre ON Genre.id = film.laisonGenre_id
//GROUP BY Genre.type

        // var_dump($query->getResult());

// !!! reste a l'afficher dans la vue !!!!!!
        return $query->getResult();

    }



    public function getLastFilm($nb)
    {
        $query = $this->getEntityManager()->createQuery(
            "SELECT f  FROM  TroiswaBackBundle:Film f ORDER BY f.dateDeRealisation DESC"

        );

        //var_dump($query->setMaxResults($nb)->getResult());
        //die();
        return  $query->setMaxResults($nb)->getResult() ;

        // equivalent en sql  SELECT COUNT( * ) , Genre.type
        //  FROM film
//JOIN Genre ON Genre.id = film.laisonGenre_id
//GROUP BY Genre.type

        // var_dump($query->getResult());

// !!! reste a l'afficher dans la vue !!!!!!
        //return $query->getResult();

    }




}
