<?php

namespace Itmo\UI\Http\Rest\Controller\Author;

use Itmo\Application\UseCases\Query\Author\Add\AddAuthorQuery;
use Itmo\Application\UseCases\Query\Author\List\ListAuthorQuery;
use Itmo\Application\UseCases\Query\QueryBusInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/author', name: 'author')]
class AuthorController
{
    public function __construct(
        private readonly QueryBusInterface $queryBus,
    ) {
    }

    #[Route(path: '/add', name: '.add', methods: ['POST'])]
    public function insert(AddAuthorQuery $query): JsonResponse
    {
        $result = $this->queryBus->ask($query);

        return new JsonResponse($result, Response::HTTP_OK, [], true);
    }

    #[Route(path: '/list', name: '.get', methods: ['GET'])]
    public function get(ListAuthorQuery $query): JsonResponse
    {
        $result = $this->queryBus->ask($query);

        return new JsonResponse($result, Response::HTTP_OK, [], true);
    }
}
