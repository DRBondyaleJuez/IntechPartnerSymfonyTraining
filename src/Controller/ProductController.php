<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private LoggerInterface $logger
    ) {
    }


    #[Route('/product/{productid}', methods: ['GET'])]
    public function displayProduct(string $productid): Response
    {
        $productRepository = $this->entityManager->getRepository(Product::class);
        $productInfo = $productRepository->findOneBy(['productid' => $productid]);

        return $this->render('product/displayProduct.html.twig', [
            'productInfo' => $productInfo
        ]);

        /*
        if($productInfo === null){
            $this->logger->error('Unable to build productInfo during insertion');
            return new Response(
                'Content',
                Response::HTTP_INTERNAL_SERVER_ERROR,
                ['content-type' => 'text/html']
            );
        } else {
            $insertProductStatus = $this->insertProduct($productInfo);
            if($insertProductStatus) {
                return $this->render('product/insertNewProduct.html.twig', [
                    'product_id' => $productInfo['productid'],
                    'product_name' => $productInfo['name']
                ]);
            } else {
                $this->logger->error('Unable to insert product in database');
                return new Response(
                    'Content',
                    Response::HTTP_INTERNAL_SERVER_ERROR,
                    ['content-type' => 'text/html']
                );
            }
        }
*/
    }


}
