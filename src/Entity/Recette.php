<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Note;

#[ORM\Entity(repositoryClass: RecetteRepository::class)]
class Recette {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(nullable: true)]
    private ?int $duree = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $date = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $instruction = null;

    /**
     * @var Collection<int, CategorieRecette>
     */
    #[ORM\ManyToMany(targetEntity: CategorieRecette::class, inversedBy: 'recettes')]
    private Collection $categories;

    /**
     * @var Collection<int, Ingredient>
     */
    #[ORM\OneToMany(targetEntity: Ingredient::class, mappedBy: 'recette')]
    private Collection $ingredients;

    #[ORM\OneToOne(mappedBy: 'recette', cascade: ['persist', 'remove'])]
    private ?Note $note = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Image $image = null;

    public function __construct() {
        $this->categories = new ArrayCollection();
        $this->ingredients = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getNom(): ?string {
        return $this->nom;
    }

    public function setNom(string $nom): static {
        $this->nom = $nom;

        return $this;
    }

    public function getDuree(): ?int {
        return $this->duree;
    }

    public function setDuree(?int $duree): static {
        $this->duree = $duree;

        return $this;
    }

    public function getDate(): ?\DateTime {
        return $this->date;
    }

    public function setDate(?\DateTime $date): static {
        $this->date = $date;

        return $this;
    }

    public function getInstruction(): ?string {
        return $this->instruction;
    }

    public function setInstruction(?string $instruction): static {
        $this->instruction = $instruction;

        return $this;
    }

    public function getNote(): ?Note {
        return $this->note;
    }

    /**
     * @return Collection<int, CategorieRecette>
     */
    public function getCategories(): Collection {
        return $this->categories;
    }

    public function addCategory(CategorieRecette $category): static {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }

        return $this;
    }

    public function removeCategory(CategorieRecette $category): static {
        $this->categories->removeElement($category);

        return $this;
    }

    /**
     * @return Collection<int, Ingredient>
     */
    public function getIngredients(): Collection {
        return $this->ingredients;
    }

    public function addIngredients(Ingredient $ingredients): static {
        if (!$this->ingredients->contains($ingredients)) {
            $this->ingredients->add($ingredients);
            $ingredients->setRecette($this);
        }

        return $this;
    }

    public function removeIngredients(Ingredient $ingredients): static {
        if ($this->ingredients->removeElement($ingredients)) {
            // set the owning side to null (unless already changed)
            if ($ingredients->getRecette() === $this) {
                $ingredients->setRecette(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $description): static {
        $this->description = $description;

        return $this;
    }

    public function isNew(): bool {
        if (!$this->date) {
            return false;
        }

        return $this->date >= new \DateTimeImmutable('-30 days');
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): static
    {
        $this->image = $image;

        return $this;
    }
}
