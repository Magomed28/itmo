<?php

namespace Itmo\Application\UseCases\Query\Author\Add;

use Itmo\Application\UseCases\Query\QueryHandlerInterface;
use Itmo\Domain\Entity\Author;
use Itmo\Infrastructure\Persistence\Doctrine\AuthorRepository;

class AddAuthorHandler implements QueryHandlerInterface
{

    public function __construct(
        private readonly AuthorRepository $authorRepository
    ) {
    }

    /**
     * Метод выполняет добавление автора
     */
    public function __invoke(AddAuthorQuery $addAuthorQuery): Author
    {
        $fio = $addAuthorQuery->getFio();

        $authorExist = $this->authorRepository->isExistByFio($fio);

        if ($authorExist) {

            throw new \Exception('Такой автор уже существует');

        }

        $author = new Author();
        $author->setFio($fio);
        $this->authorRepository->persist($author);
        $this->authorRepository->flush();

        return $author;
    }
}
