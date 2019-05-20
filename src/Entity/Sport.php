<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SportRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Sport
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $sport;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    public function __construct(){
        $this->created_at = new \DateTime;
        $this->search = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modified_at;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="sports")
     */
    private $search;

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

    public function getSport(): ?string
    {
        return $this->sport;
    }

    public function setSport(string $sport): self
    {
        $this->sport = $sport;

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

    /**
     * @return Collection|User[]
     */
    public function getSearch(): Collection
    {
        return $this->search;
    }

    public function addSearch(User $search): self
    {
        if (!$this->search->contains($search)) {
            $this->search[] = $search;
        }

        return $this;
    }

    public function removeSearch(User $search): self
    {
        if ($this->search->contains($search)) {
            $this->search->removeElement($search);
        }

        return $this;
    }
}
