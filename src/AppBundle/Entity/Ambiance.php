<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ambiance
 *
 * @ORM\Table(name="ambiance", indexes={@ORM\Index(name="designer", columns={"designer"})})
 * @ORM\Entity
 */
class Ambiance
{
    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="text", length=65535, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="public", type="boolean", nullable=false)
     */
    private $public;

    /**
     * @var boolean
     *
     * @ORM\Column(name="disponible", type="boolean", nullable=false)
     */
    private $disponible;

    /**
     * @var boolean
     *
     * @ORM\Column(name="vendu", type="boolean", nullable=false)
     */
    private $vendu;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="designer", referencedColumnName="ID")
     * })
     */
    private $designer;



    /**
     * Set titre
     *
     * @param string $titre
     * @return Ambiance
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
     * @return Ambiance
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
     * Set public
     *
     * @param boolean $public
     * @return Ambiance
     */
    public function setPublic($public)
    {
        $this->public = $public;

        return $this;
    }

    /**
     * Get public
     *
     * @return boolean 
     */
    public function getPublic()
    {
        return $this->public;
    }

    /**
     * Set disponible
     *
     * @param boolean $disponible
     * @return Ambiance
     */
    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;

        return $this;
    }

    /**
     * Get disponible
     *
     * @return boolean 
     */
    public function getDisponible()
    {
        return $this->disponible;
    }

    /**
     * Set vendu
     *
     * @param boolean $vendu
     * @return Ambiance
     */
    public function setVendu($vendu)
    {
        $this->vendu = $vendu;

        return $this;
    }

    /**
     * Get vendu
     *
     * @return boolean 
     */
    public function getVendu()
    {
        return $this->vendu;
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
     * Set designer
     *
     * @param \AppBundle\Entity\User $designer
     * @return Ambiance
     */
    public function setDesigner(\AppBundle\Entity\User $designer = null)
    {
        $this->designer = $designer;

        return $this;
    }

    /**
     * Get designer
     *
     * @return \AppBundle\Entity\User 
     */
    public function getDesigner()
    {
        return $this->designer;
    }
}
