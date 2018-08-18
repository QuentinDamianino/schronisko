<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dog
 *
 * @ORM\Table(name="dogs")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DogRepository")
 */
class Dog
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=64, unique=true)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer")
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="race", type="string", length=64)
     */
    private $race;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=64)
     */
    private $gender;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastFeed", type="datetime")
     */
    private $lastFeed;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastWalk", type="datetime")
     */
    private $lastWalk;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=64, nullable=true, unique=true)
     */
    private $image;


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
     * Set name
     *
     * @param string $name
     *
     * @return Dog
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return Dog
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set race
     *
     * @param string $race
     *
     * @return Dog
     */
    public function setRace($race)
    {
        $this->race = $race;

        return $this;
    }

    /**
     * Get race
     *
     * @return string
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return Dog
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set lastFeed
     *
     * @param \DateTime $lastFeed
     *
     * @return Dog
     */
    public function setLastFeed($lastFeed)
    {
        $this->lastFeed = $lastFeed;

        return $this;
    }

    /**
     * Get lastFeed
     *
     * @return \DateTime
     */
    public function getLastFeed()
    {
        return $this->lastFeed;
    }

    /**
     * Set lastWalk
     *
     * @param \DateTime $lastWalk
     *
     * @return Dog
     */
    public function setLastWalk($lastWalk)
    {
        $this->lastWalk = $lastWalk;

        return $this;
    }

    /**
     * Get lastWalk
     *
     * @return \DateTime
     */
    public function getLastWalk()
    {
        return $this->lastWalk;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Dog
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
}

