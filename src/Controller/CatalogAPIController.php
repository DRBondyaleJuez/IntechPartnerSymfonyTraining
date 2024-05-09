<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class CatalogAPIController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private LoggerInterface $logger
    ) {
    }


    #[Route('/catalogAPI', methods: ['GET'])]
    public function fetchProducts(): JsonResponse
    {
        $productRepository = $this->entityManager->getRepository(Product::class);
        $productInfoArray = $productRepository->findAll();

        return $this->json($productInfoArray);

    }
}