<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Photo
 *
 * @ORM\Table(name="photo", indexes={@ORM\Index(name="meuble", columns={"meuble"})})
 * @ORM\Entity
 */
class Photo
{
    /**
     * @var string
     *
     * @ORM\Column(name="url", type="text", length=65535, nullable=false)
     */
    private $url;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Meuble
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Meuble")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="meuble", referencedColumnName="id")
     * })
     */
    private $meuble;



    /**
     * Set url
     *
     * @param string $url
     * @return Photo
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
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
     * Set meuble
     *
     * @param \AppBundle\Entity\Meuble $meuble
     * @return Photo
     */
    public function setMeuble(\AppBundle\Entity\Meuble $meuble = null)
    {
        $this->meuble = $meuble;

        return $this;
    }

    /**
     * Get meuble
     *
     * @return \AppBundle\Entity\Meuble 
     */
    public function getMeuble()
    {
        return $this->meuble;
    }
}
