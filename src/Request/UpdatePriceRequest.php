<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;
use App\Enum\CategoryNameEnum;

class UpdatePriceRequest
{
    #[Assert\NotBlank]
    #[Assert\Type(type: 'string')]
    private string $productName;

    #[Assert\NotBlank]
    #[Assert\Type(type: 'integer')]
    #[Assert\GreaterThan(value: 0)]
    private int $price;

    #[Assert\NotBlank]
    #[Assert\Type(type: 'string')]
    private string $currency;

    #[Assert\NotBlank]
    #[Assert\Type(type: 'string')]
    private string $size;

    #[Assert\NotBlank]
    #[Assert\Type(type: 'string')]
    #[Assert\Choice(choices: ['Shoes', 'Jewelry'])]
    private string $category;

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

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

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }
}
