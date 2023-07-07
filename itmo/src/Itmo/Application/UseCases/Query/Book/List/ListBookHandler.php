<?php

namespace Itmo\Application\UseCases\Query\Book\List;

use Itmo\Application\UseCases\Query\QueryHandlerInterface;
use Itmo\Infrastructure\Persistence\Doctrine\BookRepository;

class ListBookHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly BookRepository $bookRepository
    ) {
    }

    /**
     * Метод выполняет получение книг
     */
    public function __invoke(ListBookQuery $listBookQuery): string
    {
        return json_encode($this->bookRepository->findAll(),JSON_OBJECT_AS_ARRAY);
    }
}
