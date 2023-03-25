<?php

namespace App\Entity;

use App\Enum\CategoryNameEnum;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "products")]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    private string $name;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    private string $category;

    #[ORM\OneToMany(mappedBy: "product", targetEntity: "ProductSize", cascade: ["persist", "remove"], orphanRemoval: true)]
    private Collection $productSizes;

    public function __construct(string $name, string $category)
    {
        $this->name = $name;
        $this->category = $category;
        $this->productSizes = new ArrayCollection();
    }

    // getters and setters

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

    public function getCategory(): CategoryNameEnum
    {
        return CategoryNameEnum::from($this->category);
    }

    public function setCategory(CategoryNameEnum $category): self
    {
        $this->category = $category->value;

        return $this;
    }

    /**
     * @return Collection|ProductSize[]
     */
    public function getProductSizes(): Collection
    {
        return $this->productSizes;
    }

    public function addProductSize(ProductSize $productSize): self
    {
        if (!$this->productSizes->contains($productSize)) {
            $this->productSizes[] = $productSize;
            $productSize->setProduct($this);
        }

        return $this;
    }

    public function removeProductSize(ProductSize $productSize): self
    {
        if ($this->productSizes->contains($productSize)) {
            $this->productSizes->removeElement($productSize);
            // set the owning side to null (unless already changed)
            if ($productSize->getProduct() === $this) {
                $productSize->setProduct(null);
            }
        }

        return $this;
    }
}
