<?php

namespace App\Entity;

use App\Repository\NoteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoteRepository::class)]
class Note {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $noteAspect = null;

    #[ORM\Column]
    private ?int $noteOdeur = null;

    #[ORM\Column]
    private ?int $noteGout = null;

    #[ORM\Column]
    private ?int $noteTexture = null;

    #[ORM\OneToOne(inversedBy: 'note', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Recette $recette = null;

    public function getId(): ?int {
        return $this->id;
    }

    public function getNoteAspect(): ?int {
        return $this->noteAspect;
    }

    public function setNoteAspect(int $noteAspect): static {
        $this->noteAspect = $noteAspect;

        return $this;
    }

    public function getNoteOdeur(): ?int {
        return $this->noteOdeur;
    }

    public function setNoteOdeur(int $noteOdeur): static {
        $this->noteOdeur = $noteOdeur;

        return $this;
    }

    public function getNoteGout(): ?int {
        return $this->noteGout;
    }

    public function setNoteGout(int $noteGout): static {
        $this->noteGout = $noteGout;

        return $this;
    }

    public function getNoteTexture(): ?int {
        return $this->noteTexture;
    }

    public function setNoteTexture(int $noteTexture): static {
        $this->noteTexture = $noteTexture;

        return $this;
    }

    public function getRecette(): ?Recette {
        return $this->recette;
    }

    public function setRecette(?Recette $recette): static {
        $this->recette = $recette;

        return $this;
    }

    public function getTotal(): int {
        return $this->noteAspect + $this->noteOdeur + $this->noteGout + $this->noteTexture;
    }
}
