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
}
