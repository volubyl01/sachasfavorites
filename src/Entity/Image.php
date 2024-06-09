<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'illustration')]
    private ?Element $image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?Element
    {
        return $this->image;
    }

    public function setImage(?Element $image): static
    {
        $this->image = $image;

        return $this;
    }
}
