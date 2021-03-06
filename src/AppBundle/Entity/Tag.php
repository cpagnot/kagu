<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TagRepository") * 
 * @ORM\Table(name="tag", indexes={@ORM\Index(name="ambiance", columns={"ambiance"})})
 * @ORM\Entity
 */
class Tag
{
    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="text", length=65535, nullable=false)
     */
    private $tag;

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
     *   @ORM\JoinColumn(name="ambiance", referencedColumnName="id")
     * })
     */
    private $ambiance;



    /**
     * Set tag
     *
     * @param string $tag
     * @return Tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string 
     */
    public function getTag()
    {
        return $this->tag;
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
     * Set ambiance
     *
     * @param \AppBundle\Entity\Ambiance $ambiance
     * @return Tag
     */
    public function setAmbiance(\AppBundle\Entity\Ambiance $ambiance = null)
    {
        $this->ambiance = $ambiance;

        return $this;
    }

    /**
     * Get ambiance
     *
     * @return \AppBundle\Entity\Ambiance 
     */
    public function getAmbiance()
    {
        return $this->ambiance;
    }
}
