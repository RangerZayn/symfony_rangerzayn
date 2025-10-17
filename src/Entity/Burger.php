<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Burger
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'float', scale: 2)]
    private $price;

    // Relation ManyToOne avec Pain (un pain par burger)
    #[ORM\ManyToOne(targetEntity: Pain::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $pain;

    // Relation ManyToMany avec Oignon (plusieurs oignons possibles)
    #[ORM\ManyToMany(targetEntity: Oignon::class)]
    private $oignons;

    // Relation ManyToMany avec Sauce (plusieurs sauces possibles)
    #[ORM\ManyToMany(targetEntity: Sauce::class)]
    private $sauces;

    // Relation OneToOne avec Image (une seule image par burger)
    #[ORM\OneToOne(targetEntity: Image::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $image;

    // Relation OneToMany avec Commentaire (plusieurs commentaires pour un burger)
    #[ORM\OneToMany(targetEntity: Commentaire::class, mappedBy: 'burger')]
    private $commentaires;

    public function __construct()
    {
        $this->oignons = new ArrayCollection();
        $this->sauces = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getPain(): Pain
    {
        return $this->pain;
    }

    public function setPain(Pain $pain): void
    {
        $this->pain = $pain;
    }

    public function getOignons(): Collection
    {
        return $this->oignons;
    }

    public function addOignon(Oignon $oignon): self
    {
        if (!$this->oignons->contains($oignon)) {
            $this->oignons[] = $oignon;
        }

        return $this; 
    }

    public function removeOignon(Oignon $oignon): self
    {
        $this->oignons->removeElement($oignon);

        return $this;
    }

    public function getSauces(): Collection
    {
        return $this->sauces;
    }

    public function addSauce(Sauce $sauce): self
    {
        if (!$this->sauces->contains($sauce)) {
            $this->sauces[] = $sauce;
        }

        return $this;
    }

    public function removeSauce(Sauce $sauce): self
    {
        $this->sauces->removeElement($sauce);

        return $this;
    }

    public function getImage(): Image
    {
        return $this->image;
    }

    public function setImage(Image $image): void
    {
        $this->image = $image;
    }

    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setBurger($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getBurger() === $this) {
                $commentaire->setBurger(null);
            }
        }

        return $this;
    }
}
