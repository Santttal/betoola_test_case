<?php

namespace App\Repository;

use App\Entity\Product;
use App\Entity\ProductSize;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProductSizeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductSize::class);
    }

    public function findByProductAndSize(Product $product, string $size): ?ProductSize
    {
        return $this->findOneBy(['product' => $product, 'size' => $size]);
    }
}
