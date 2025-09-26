<?php

namespace App\Entity;

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
    #[ORM\OneToOne(targetEntity: Image::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $image;

    // Relation OneToMany avec Commentaire (plusieurs commentaires pour un burger)
    #[ORM\OneToMany(targetEntity: Commentaire::class, mappedBy: 'burger')]
    private $commentaires;

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

    public function getOignons(): array
    {
        return $this->oignons;
    }

    public function setOignons(array $oignons): void
    {
        $this->oignons = $oignons;
    }

    public function getSauces(): array
    {
        return $this->sauces;
    }

    public function setSauces(array $sauces): void
    {
        $this->sauces = $sauces;
    }

    public function getImage(): Image
    {
        return $this->image;
    }

    public function setImage(Image $image): void
    {
        $this->image = $image;
    }
    public function getCommentaires(): array
    {
        return $this->commentaires;
    }

    public function setCommentaires(array $commentaires): void
    {
        $this->commentaires = $commentaires;
    }
}