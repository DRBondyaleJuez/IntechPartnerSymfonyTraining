<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ShoppingCartController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private LoggerInterface $logger,
        private $shoppingCartContent = ""
    ) {
    }

    #[Route('/shoppingCart', methods: ['PUT'])]
    public function modifyShoppingCartContent(Request $request): Response
    {
        $this->logger->info('######## MODIFYING SHOPPING CART CONTENT');

        $newShoppingCartContentJSON = $request->getContent();
        $this->logger->info('######## User info:'.$newShoppingCartContentJSON);

        $this->shoppingCartContent = $newShoppingCartContentJSON;

        return new Response(
            'Content',
            Response::HTTP_OK,
            ['content-type' => 'text/html']
        );
    }

    #[Route('/shoppingCart', methods: ['GET'])]
    public function getShoppingCartContent(Request $request): JsonResponse
    {
        $this->logger->info('######## RETURNING SHOPPING CART CONTENT');

        return $this->json($this->shoppingCartContent);
    }


}