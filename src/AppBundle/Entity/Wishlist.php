<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Wishlist
 */
class Wishlist
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Ambiance
     */
    private $ambiance;

    /**
     * @var \AppBundle\Entity\User
     */
    private $user;


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
     * @return Wishlist
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

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     * @return Wishlist
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
