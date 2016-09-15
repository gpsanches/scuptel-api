<?php

namespace Sprinklr\ScupTel\Application\Controller;

use JMS\Serializer\SerializerInterface;
use Psr\Log\LoggerInterface;
use Sprinklr\ScupTel\Domain\Dto\CollectionDto;
use Sprinklr\ScupTel\Domain\Repository\PriceRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PriceController extends ApiController
{
    private $logger;
    private $repository;

    public function __construct(
        LoggerInterface $logger,
        SerializerInterface $serializer,
        PriceRepositoryInterface $repository
    ) {
        parent::__construct($serializer);

        $this->logger = $logger;
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $this->logger->addInfo('PriceController :: index()');

        $entities = $this->repository->findAll();

        $collection = new CollectionDto($entities);

        return $this->buildResponse($request, $collection, Response::HTTP_OK);
    }
}
