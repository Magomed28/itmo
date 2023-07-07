<?php

namespace Itmo\Application\UseCases\Query\Author\List;

use Itmo\Application\UseCases\Query\QueryHandlerInterface;
use Itmo\Infrastructure\Persistence\Doctrine\AuthorRepository;

class ListAuthorHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly AuthorRepository $authorRepository
    ) {
    }

    /**
     * Метод выполняет получение авторов
     */
    public function __invoke(ListAuthorQuery $listAuthorQuery): string
    {
        return json_encode($this->authorRepository->findAll(),JSON_OBJECT_AS_ARRAY);
    }
}
