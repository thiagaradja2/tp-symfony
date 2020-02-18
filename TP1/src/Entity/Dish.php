<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DishRepository")
 */
class Dish
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Calories;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Image;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(
     *      min = 10,
     *      max = 100,
     *      minMessage = "The description must be at least {{ limit }} characters long",
     *      maxMessage = "The description cannot be longer than {{ limit }} characters"
     * )
     */
    private $Description;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Sticky;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category", inversedBy="dishes")
     */
    private $Category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="dishes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Allergen", inversedBy="dishes")
     */
    private $allergens;

    public function __construct()
    {
        $this->Category = new ArrayCollection();
        $this->allergens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getCalories(): ?int
    {
        return $this->Calories;
    }

    public function setCalories(?int $Calories): self
    {
        $this->Calories = $Calories;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(?float $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getSticky(): ?bool
    {
        return $this->Sticky;
    }

    public function setSticky(?bool $Sticky): self
    {
        $this->Sticky = $Sticky;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategory(): Collection
    {
        return $this->Category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->Category->contains($category)) {
            $this->Category[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->Category->contains($category)) {
            $this->Category->removeElement($category);
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    /**
     * @return Collection|Allergen[]
     */
    public function getAllergens(): Collection
    {
        return $this->allergens;
    }

    public function addAllergen(Allergen $allergen): self
    {
        if (!$this->allergens->contains($allergen)) {
            $this->allergens[] = $allergen;
        }

        return $this;
    }

    public function removeAllergen(Allergen $allergen): self
    {
        if ($this->allergens->contains($allergen)) {
            $this->allergens->removeElement($allergen);
        }

        return $this;
    }



    public function __toString()
    {
        return $this->Name;
    }

}
