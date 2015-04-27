<?php

namespace Troiswa\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Genre
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Troiswa\BackBundle\Entity\GenreRepository")
 */
class Genre
{
    /**
     * @var integer
     * @Assert\NotBlank(message="Attention")
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = " le type doit etre superieure a 2 caracteres",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     *
     * @ORM\Column(name="type", type="string", length=150)
     * @Assert\NotBlank(message="Attention")
     */
    private $type;

    /**
     * @var string
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = " le type doit etre superieure a 2 caracteres",
     *      maxMessage = "la description doit etre inferireure a 300 caracteres"
     * )
     * @Assert\NotBlank(message="Attention")
     * @ORM\Column(name="description", type="text")
     */
    private $description;




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
     * Set type
     *
     * @param string $type
     * @return Genre
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Genre
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
}
