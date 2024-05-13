<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

class CatalogAPIController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private LoggerInterface $logger,
        private String $NON_VALID_SORT_CRITERIA = 'Non valid sort criteria'
    ) {
    }

    #[Route('/catalogAPI', methods: ['GET'])]
    public function fetchProducts(Request $request): JsonResponse
    {
        $this->logger->info('######## PROCESSING CATALOG PRODUCT REQUEST');

        //Getting query params
        $sortParam = $request->query->getString('sortBy');
        $filterParam = $request->query->getString('filterBy');

        //Sort Criteria handling, parsing and validate sortby label
        $sortCriteria = $this->sortParser($sortParam);
        if($sortCriteria == $this->NON_VALID_SORT_CRITERIA){
            $this->logger->error('######## INVALID SORT LABEL: ' . $sortCriteria);
            return new JsonResponse(
                'Non-valid sort label in request', JsonResponse::HTTP_BAD_REQUEST
            );
        }

        $productRepository = $this->entityManager->getRepository(Product::class);
        $productInfoArray = [];
        if(empty($filterParam)){
            //NO FILTER CRITERIA SECNARIO
            $productInfoArray = $productRepository->getSortedProductList($sortCriteria);

            $this->logger->info('######## RETURNING PRODUCT LIST SORTED BY ' . $sortCriteria);
        } else {
            //WITH FILTER CRITERIA SCENARIO
            $productInfoArray = $productRepository->getSortedAndFilteredProductList($sortCriteria,$filterParam);
        }

        $this->logger->info('######## RETURNING PRODUCT LIST SORTED BY ' . $sortCriteria . ' AND FILTERED BY ' . $filterParam);
        return $this->json($productInfoArray);
    }

    private function sortParser(String $sortDisplayName): String
    {
        $sortDatabaseName = '';

        switch($sortDisplayName){
            case('id'):
                $sortDatabaseName = 'id';
                break;
            case('Name'):
                $sortDatabaseName = 'name';
                break;
            case('Price'):
                $sortDatabaseName = 'offerprice';
                break;
            case('ProductID'):
                $sortDatabaseName = 'productid';
                break;
            default:
                $sortDatabaseName = $this->NON_VALID_SORT_CRITERIA;
        }
        return $sortDatabaseName;
    }


}