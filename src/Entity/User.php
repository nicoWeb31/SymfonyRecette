<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 * fields={"username"},
 * message="existe deja")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5,max=10,minMessage="il faut plus de 5 carractere",maxMessage="max 10 carractere")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5,max=10,minMessage="il faut plus de 5 carractere",maxMessage="max 10 carractere")
     */
    private $pass;

    /**
     * @Assert\Length(min=5,max=10,minMessage="il faut plus de 5 carractere",maxMessage="max 10 carractere")
     * @Assert\EqualTo(propertyPath="pass",message ="mots de pass different")
     */
    private $passVerif;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPass(): ?string
    {
        return $this->pass;
    }

    public function setPass(string $pass): self
    {
        $this->pass = $pass;

        return $this;
    }

    /**
     * Get the value of passVerif
     */ 
    public function getPassVerif()
    {
        return $this->passVerif;
    }

    /**
     * Set the value of passVerif
     *
     * @return  self
     */ 
    public function setPassVerif($passVerif)
    {
        $this->passVerif = $passVerif;

        return $this;
    }

    public function eraseCredentials()
    {
        
    }

    public function getSalt()
    {
        
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }
}
