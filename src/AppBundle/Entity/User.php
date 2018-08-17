<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 14.08.2018
 * Time: 00:47
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * Class User
 * @ORM\Table(name="app_users")
 * @ORM\Entity
 */

class User implements AdvancedUserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */

    private $id;

    /**
     * @ORM\Column(type="string" , length=25, unique=true)
     */

    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     */

    private $password;

    /**
     * @ORM\Column(type="string", length=190, unique=true)
     */

    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */

    private $isActive;

    public function __construct()
    {
        $this->isActive = true;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getSalt()
    {
        return null;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->isActive,
        ));
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->password,
            $this->isActive,
            ) = unserialize($serialized);
    }
}