<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $sprite = null;

    /**
     * @ORM\Column(type="array")
     */
    private $pokemons = [];

    public function __construct()
    {
        $this->pokemons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSprite(): ?string
    {
        return $this->sprite;
    }

    public function setSprite(string $sprite): static
    {
        $this->sprite = $sprite;

        return $this;
    }

    public function addPokemon(string $pokemonSprite): self
    {
        if (!in_array($pokemonSprite, $this->pokemons->toArray())) {
            $this->pokemons[] = $pokemonSprite;
        }

        return $this;
    }

    public function getPokemons(): Collection
    {
        return $this->pokemons;
    }
}
