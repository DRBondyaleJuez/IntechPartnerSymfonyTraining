<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    //    /**
    //     * @return Product[] Returns an array of Product objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Product
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function getSortedProductList(string $sortCriteria): array
    {
        return$this->createQueryBuilder('p')
        ->orderBy('p.' . $sortCriteria,'ASC')
        ->getQuery()
        ->getResult();
    }

    public function getSortedAndFilteredProductList(string $sortCriteria, string $filterCriteria): array
    {
        $upperCaseFilterCriteria = strtoupper($filterCriteria);
        return$this->createQueryBuilder('p')
        ->andWhere('UPPER(p.name) LIKE :filterVal OR UPPER(p.description) LIKE :filterVal')
        ->setParameter('filterVal', '%'.$upperCaseFilterCriteria.'%')
        ->orderBy('p.' . $sortCriteria,'ASC')
        ->getQuery()
        ->getResult();
    }

}
