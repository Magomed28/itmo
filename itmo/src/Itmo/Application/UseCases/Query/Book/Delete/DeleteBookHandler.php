<?php

namespace Itmo\Application\UseCases\Query\Book\Delete;

use Itmo\Application\UseCases\Query\QueryHandlerInterface;
use Itmo\Domain\Entity\Book;
use Itmo\Infrastructure\Persistence\Doctrine\BookRepository;

class DeleteBookHandler implements QueryHandlerInterface
{

    public function __construct(
        private readonly BookRepository $bookRepository
    ) {
    }

    /**
     * Метод выполняет добавление автора
     */
    public function __invoke(DeleteBookQuery $deleteBookQuery): Book
    {
        $id = $deleteBookQuery->getId();

        $book = $this->bookRepository->findById($id);

        if (!isset($book)) {

            throw new \Exception('Такой книги не существует');

        }

        foreach ($book->getAuthors() as $author){
            $book->getAuthors()->removeElement($author);
            $author->getBooks()->removeElement($book);
        }

        $this->bookRepository->flush();

        $this->bookRepository->removeById($id);

        $this->bookRepository->flush();

        return $book;
    }
}
