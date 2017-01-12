<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContenuResa
 *
 * @ORM\Table(name="contenu_resa", indexes={@ORM\Index(name="reservation", columns={"reservation"}), @ORM\Index(name="meuble", columns={"meuble"})})
 * @ORM\Entity
 */
class ContenuResa
{
    /**
     * @var \AppBundle\Entity\Reservation
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Reservation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reservation", referencedColumnName="id")
     * })
     */
    private $reservation;

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
     * Set reservation
     *
     * @param \AppBundle\Entity\Reservation $reservation
     * @return ContenuResa
     */
    public function setReservation(\AppBundle\Entity\Reservation $reservation)
    {
        $this->reservation = $reservation;

        return $this;
    }

    /**
     * Get reservation
     *
     * @return \AppBundle\Entity\Reservation 
     */
    public function getReservation()
    {
        return $this->reservation;
    }

    /**
     * Set meuble
     *
     * @param \AppBundle\Entity\Meuble $meuble
     * @return ContenuResa
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
