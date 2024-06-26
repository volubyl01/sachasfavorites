<?php 
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TeamRepository;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique:true)]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: Dresseur::class, inversedBy: 'teams')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Dresseur $dresseur = null;

    #[ORM\OneToMany(targetEntity: Pokemon::class, mappedBy: 'team', cascade: ["persist", "remove"])]
    private Collection $pokemons;

    public function __construct()
    {
        $this->pokemons = new ArrayCollection();
    }

    /**
     * @return Collection|Pokemon[]
     */
    public function getPokemons(): Collection
    {
        return $this->pokemons;
    }

    public function addPokemon(Pokemon $pokemon): self
    {
        if (!$this->pokemons->contains($pokemon)) {
            $this->pokemons[] = $pokemon;
            $pokemon->setTeam($this);
        }

        return $this;
    }

    public function removePokemon(Pokemon $pokemon): self
    {
        if ($this->pokemons->removeElement($pokemon)) {
            // set the owning side to null (unless already changed)
            if ($pokemon->getTeam() === $this) {
                $pokemon->setTeam(null);
            }
        }

        return $this;
    }

    /**
     * Get the value of id
     *
     * @return ?int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param ?int $id
     *
     * @return self
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     *
     * @return ?string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param ?string $name
     *
     * @return self
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of dresseur
     *
     * @return ?Dresseur
     */
    public function getDresseur(): ?Dresseur
    {
        return $this->dresseur;
    }

    /**
     * Set the value of dresseur
     *
     * @param ?Dresseur $dresseur
     *
     * @return self
     */
    public function setDresseur(?Dresseur $dresseur): self
    {
        $this->dresseur = $dresseur;

        return $this;
    }
}
