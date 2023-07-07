<?php

namespace Itmo\Application\UseCases\Query\Author\Delete;

use Itmo\Application\UseCases\Query\QueryHandlerInterface;
use Itmo\Domain\Entity\Author;
use Itmo\Infrastructure\Persistence\Doctrine\AuthorRepository;

class DeleteAuthorHandler implements QueryHandlerInterface
{

    public function __construct(
        private readonly AuthorRepository $authorRepository
    ) {
    }

    /**
     * Метод выполняет добавление автора
     */
    public function __invoke(DeleteAuthorQuery $deleteAuthorQuery): Author
    {
        $id = $deleteAuthorQuery->getId();

        $author = $this->authorRepository->findById($id);

        if (!isset($author)) {

            throw new \Exception('Такого автора не существует');

        }

        foreach ($author->getBooks() as $book){
            $book->getAuthors()->removeElement($author);
            $author->getBooks()->removeElement($book);
        }

        $this->authorRepository->flush();

        $this->authorRepository->removeById($id);

        $this->authorRepository->flush();

        return $author;
    }
}
