<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Commentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: Burger::class, inversedBy: "commentaires")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Burger $burger = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getBurger(): ?Burger
    {
        return $this->burger;
    }
    public function setBurger(?Burger $burger): self
    {
        $this->burger = $burger;
        return $this;
    }
}
