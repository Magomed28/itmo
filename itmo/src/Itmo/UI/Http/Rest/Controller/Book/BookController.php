<?php

namespace Itmo\UI\Http\Rest\Controller\Book;

use Itmo\Application\UseCases\Query\Book\Add\AddBookQuery;
use Itmo\Application\UseCases\Query\QueryBusInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/book', name: 'book')]
class BookController
{
    public function __construct(
        private readonly QueryBusInterface $queryBus,
    ) {
    }

    #[Route(path: '/add', name: '.add', methods: ['POST'])]
    public function insert(AddBookQuery $query): JsonResponse
    {
        $result = $this->queryBus->ask($query);

        return new JsonResponse($result, Response::HTTP_OK, [], true);
    }
}
