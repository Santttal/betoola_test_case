<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "product_sizes")]
class ProductSize
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\ManyToOne(targetEntity: "Product", inversedBy: "productSizes")]
    #[ORM\JoinColumn(nullable: false)]
    private Product $product;

    #[ORM\Column(type: "string", length: 20, nullable: false)]
    private string $size;

    #[ORM\ManyToOne(targetEntity: "Price", inversedBy: "productSizes")]
    private ?Price $price;

    public function __construct(Product $product, string $size)
    {
        $this->product = $product;
        $this->size = $size;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getSize(): string
    {
        return $this->size;
    }

    public function setSize(string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function setPrice(Price $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPrice(): ?Price
    {
        return $this->price;
    }
}
