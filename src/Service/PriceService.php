<?php

namespace App\Service;

use App\Entity\Price;
use App\Entity\Product;
use App\Enum\CategoryNameEnum;
use App\Exception\NotFoundException;
use App\Repository\ProductRepository;
use App\Repository\ProductSizeRepository;
use Doctrine\ORM\EntityManagerInterface;

class PriceService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly ProductRepository $productRepository,
        private readonly ProductSizeRepository $productSizeRepository,
    ) {
    }

    public function createOrUpdate(
        string $productName,
        string $category,
        int $amount,
        string $currency,
        string $size,
    ): Product {
        $product = $this->productRepository->findByNameAndCategory($productName, $category);
        if (!$product) {
            throw new NotFoundException('Product not found with name: ' . $productName);
        }

        $productSize = $this->productSizeRepository->findByProductAndSize($product, $size);
        if (!$productSize) {
            throw new NotFoundException('Product size not found with name: ' . $size);
        }

        $price = $productSize->getPrice();

        if (!$price) {
            $price = new Price($amount, $currency);
            $productSize->setPrice($price);
            $this->entityManager->persist($price);
        } else {
            $price->setAmount($amount);
            $price->setCurrency($currency);
        }

        if ($product->getCategory() === CategoryNameEnum::SHOES) {
            $this->createOfUpdateForOtherSizes($product, $price);
        }

        return $product;
    }

    private function createOfUpdateForOtherSizes(Product $product, Price $price): void
    {
        foreach ($product->getProductSizes() as $productSize) {
            $productSize->setPrice($price);
            $this->entityManager->persist($productSize);
        }
    }
}
