<?php

namespace Troiswa\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Film
 *
 * @ORM\Table(name="film")
 * @ORM\Entity(repositoryClass="Troiswa\BackBundle\Entity\FilmRepository")
 */
class Film
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var string
     * @Assert\Image(
     *     maxSize = "2500000",
     *     mimeTypes = {"image/png", "image/jpg", "image/jpeg"}
     * )
     *
     */
    public $fichier;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=150)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDeRealisation", type="datetime")
     */
    private $dateDeRealisation;

    /**
     * @var integer
     *
     * @ORM\Column(name="note", type="integer")
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=100)
     */
    private $image;


    /**
     *
     *
     * @ORM\ManyToOne(targetEntity="Troiswa\BackBundle\Entity\Genre")
     */
    private $laisonGenre;





    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Film
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Film
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateDeRealisation
     *
     * @param \DateTime $dateDeRealisation
     * @return Film
     */
    public function setDateDeRealisation($dateDeRealisation)
    {
        $this->dateDeRealisation = $dateDeRealisation;

        return $this;
    }

    /**
     * Get dateDeRealisation
     *
     * @return \DateTime 
     */
    public function getDateDeRealisation()
    {
        return $this->dateDeRealisation;
    }

    /**
     * Set note
     *
     * @param integer $note
     * @return Film
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return integer 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Film
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set laisonGenre
     *
     * @param \Troiswa\BackBundle\Entity\Genre $laisonGenre
     * @return Film
     */
    public function setLaisonGenre(\Troiswa\BackBundle\Entity\Genre $laisonGenre = null)
    {
        $this->laisonGenre = $laisonGenre;

        return $this;
    }

    /**
     * Get laisonGenre
     *
     * @return \Troiswa\BackBundle\Entity\Genre 
     */
    public function getLaisonGenre()
    {
        return $this->laisonGenre;
    }

    public function getFichier()
    {
        return $this->fichier;
    }

    public function setFichier($fichier=null)
    {
        $this->fichier = $fichier;

        return $this;
    }

    public function upload()
    {
        $nomImage = uniqid()."_".$this->fichier->getClientOriginalName();

        if ($this->fichier === null)
        {
            return;
        }

        $this->fichier->move(__DIR__."/../../../../web/images",$nomImage);

        $this->image = $nomImage;

        $this->fichier = null;
    }
}
