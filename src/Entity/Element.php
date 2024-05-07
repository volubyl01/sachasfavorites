<?php

namespace App\Entity;

use App\Repository\ElementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ElementRepository::class)]
class Element
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\OneToMany(targetEntity: Pokemon::class, mappedBy: 'element')]
    private Collection $level;

    public function __construct()
    {
        $this->level = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Pokemon>
     */
    public function getLevel(): Collection
    {
        return $this->level;
    }

    public function addLevel(Pokemon $level): static
    {
        if (!$this->level->contains($level)) {
            $this->level->add($level);
            $level->setElement($this);
        }

        return $this;
    }

    public function removeLevel(Pokemon $level): static
    {
        if ($this->level->removeElement($level)) {
            // set the owning side to null (unless already changed)
            if ($level->getElement() === $this) {
                $level->setElement(null);
            }
        }

        return $this;
    }
}
