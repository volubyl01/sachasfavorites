<?php

namespace App\Entity;

use App\Repository\ElementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Pokemon;

#[ORM\Entity(repositoryClass: ElementRepository::class)]
class Element
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $specificite=null;

    #[ORM\Column(nullable: true)]
    private ?int $level = null;

    #[ORM\OneToMany(targetEntity: Pokemon::class, mappedBy: 'Elements')]
    private Collection $pokemons;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $illustration = null;

 

    public function __construct()
    {
        $this->pokemons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpecificite(): ?string
    {
        return $this->specificite;
    }

    public function setSpecificite(?string $specificite): self
    {
        $this->specificite = $specificite;

        return $this;
    }

    
    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(?int $level): self
    {
        $this->level = $level;

        return $this;
    }
/**
     * @return Collection<int, Pokemon>
     */

    public function addPokemon(Pokemon $pokemon): self
    {
        if (!$this->pokemons->contains($pokemon)) {
            $this->pokemons->add($pokemon);
            $pokemon->setElement($this);
        }

        return $this;
    }

    public function removePokemon(Pokemon $pokemon): self
    {
        if ($this->pokemons->removeElement($pokemon)) {
            // set the owning side to null (unless already changed)
            if ($pokemon->getElement() === $this) {
                $pokemon->setElement(null);
            }
        }

        return $this;
    }

    public function getIllustration(): ?string
    {
        return $this->illustration ? '/uploads/Image/' . $this->illustration : null;
    }

    public function setIllustration(?string $illustration): self
    {
        $this->illustration = $illustration;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */

}
