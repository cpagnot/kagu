<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Meuble
 *
 * @ORM\Table(name="meuble", indexes={@ORM\Index(name="annonce", columns={"annonce"})})
 * @ORM\Entity
 */
class Meuble
{
    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;
    
    /**
     * @var float
     *
     * @ORM\Column(name="prix_loc", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix_loc;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="text", length=65535, nullable=false)
     */
    private $titre;

    /**
     * @var integer
     *
     * @ORM\Column(name="x", type="float", nullable=false)
     */
    private $x;

    /**
     * @var integer
     *
     * @ORM\Column(name="y", type="float", nullable=false)
     */
    private $y;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Ambiance
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ambiance")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="annonce", referencedColumnName="id")
     * })
     */
    private $annonce;



    /**
     * Set prix
     *
     * @param float $prix
     * @return Meuble
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float 
     */
    public function getPrix()
    {
        return $this->prix;
    }
    
     /**
     * Set prix
     *
     * @param float $prix_loc
     * @return Meuble
     */
    public function setPrixLoc($prix_loc)
    {
        $this->prix_loc = $prix_loc;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float 
     */
    public function getPrixLoc()
    {
        return $this->prix_loc;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Meuble
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
     * Set titre
     *
     * @param string $titre
     * @return Meuble
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
     * Set x
     *
     * @param integer $x
     * @return Meuble
     */
    public function setX($x)
    {
        $this->x = $x;

        return $this;
    }

    /**
     * Get x
     *
     * @return integer 
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Set y
     *
     * @param integer $y
     * @return Meuble
     */
    public function setY($y)
    {
        $this->y = $y;

        return $this;
    }

    /**
     * Get y
     *
     * @return integer 
     */
    public function getY()
    {
        return $this->y;
    }

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
     * Set annonce
     *
     * @param \AppBundle\Entity\Ambiance $annonce
     * @return Meuble
     */
    public function setAnnonce(\AppBundle\Entity\Ambiance $annonce = null)
    {
        $this->annonce = $annonce;

        return $this;
    }

    /**
     * Get annonce
     *
     * @return \AppBundle\Entity\Ambiance 
     */
    public function getAnnonce()
    {
        return $this->annonce;
    }
    /**
     * @var float
     */
    private $prixLoc;


}
