<?php

namespace App\Controller;

use App\Exception\NotFoundException;
use App\Request\UpdatePriceRequest;
use App\Service\PriceService;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/api/products")
 */
class ProductApiController extends AbstractController
{
    public function __construct(
        private readonly PriceService $priceService,
        private readonly ValidatorInterface $validator,
        private readonly EntityManagerInterface $entityManager,
        private readonly SerializerInterface $serializer,
    ) {
    }

    #[Route('/prices', name: 'api_update_price')]
    public function updatePrice(Request $request): JsonResponse
    {
        $requestData = $request->getContent();
        /** @var UpdatePriceRequest $updatePriceRequest */
        $updatePriceRequest = $this->serializer->deserialize($requestData, UpdatePriceRequest::class, 'json');


        $errors = $this->validator->validate($updatePriceRequest);

        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[$error->getPropertyPath()] = $error->getMessage();
            }
            return new JsonResponse(['errors' => $errorMessages], JsonResponse::HTTP_BAD_REQUEST);
        }

        try {
            $this->priceService->createOrUpdate(
                $updatePriceRequest->getProductName(),
                $updatePriceRequest->getCategory(),
                $updatePriceRequest->getPrice(),
                $updatePriceRequest->getCurrency(),
                $updatePriceRequest->getSize()
            );

            $this->entityManager->flush();
        } catch (NotFoundException $e) {
            return new JsonResponse(['errors' => ['product' => $e->getMessage()]], JsonResponse::HTTP_NOT_FOUND);
        }


        return new JsonResponse(['success' => true]);
    }

}
