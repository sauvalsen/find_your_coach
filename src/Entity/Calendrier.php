<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CalendrierRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Calendrier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="find_your_coach\src\Entity\User")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank
     * @Assert\DateTime
     * @var string A "d/m/Y H:i'" formatted value
     */
    private $start_date;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank
     * @Assert\DateTime
     * @var string A "d/m/Y H:i'" formatted value
     */
    private $end_date;

  
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank
    * @Assert\Length(
     * min = 2,
     * max = 100,
     * minMessage = "Le titre doit contenir un minimum de {{ limit }} caractères",
     * maxMessage = "Le titre ne doit pas dépasser {{ limit }} caractères"
     * )
     */
    private $titre;

    /**
     * @ORM\Column(type="datetime")
     
     */
    private $created_at;

    public function __construct(){
        $this->created_at = new \DateTime;
        $this->users = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modified_at;
/////Permet de récuper l'ID des sportif en faisant un many to one
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="calendriers")
     */
    private $sportif;
/////Permet de récuper l'ID des coach en faisant un many to one
    /**
     * @Assert\NotBlank
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $coach;

 

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate(){
        $this->modified_at = new \DateTime;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(?\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }



    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getModifiedAt(): ?\DateTimeInterface
    {
        return $this->modified_at;
    }

    public function setModifiedAt(?\DateTimeInterface $modified_at): self
    {
        $this->modified_at = $modified_at;

        return $this;
    }
//////////Permet de récupérer l'ID Sportif\\\\\\\\\\\\\
    public function getSportif(): ?User
    {
        return $this->sportif;
    }

    public function setSportif(?User $sportif): self
    {
        $this->sportif = $sportif;

        return $this;
    }
//////////Permet de récupérer l'ID Coach\\\\\\\\\\\\\\\\\\
    public function getCoach(): ?User
    {
        return $this->coach;
    }

    public function setCoach(?User $coach): self
    {
        $this->coach = $coach;

        return $this;
    }

  
    
}
