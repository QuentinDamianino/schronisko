<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shelter
 *
 * @ORM\Table(name="shelter")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ShelterRepository")
 */
class Shelter
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="rooms", type="integer")
     */
    private $rooms;

    /**
     * @var int
     *
     * @ORM\Column(name="occupiedRooms", type="integer")
     */
    private $occupiedRooms;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set rooms
     *
     * @param integer $rooms
     *
     * @return Shelter
     */
    public function setRooms($rooms)
    {
        $this->rooms = $rooms;

        return $this;
    }

    /**
     * Get rooms
     *
     * @return int
     */
    public function getRooms()
    {
        return $this->rooms;
    }

    /**
     * Set occupiedRooms
     *
     * @param integer $occupiedRooms
     *
     * @return Shelter
     */
    public function setOccupiedRooms($occupiedRooms)
    {
        $this->occupiedRooms = $occupiedRooms;

        return $this;
    }

    /**
     * Get occupiedRooms
     *
     * @return int
     */
    public function getOccupiedRooms()
    {
        return $this->occupiedRooms;
    }
}

