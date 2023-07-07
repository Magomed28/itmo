<?php

namespace Itmo\Application\UseCases\Query\Book\Update;

use Itmo\Application\UseCases\Query\QueryHandlerInterface;
use Itmo\Domain\Entity\Book;
use Itmo\Infrastructure\Persistence\Doctrine\BookRepository;

class UpdateBookHandler implements QueryHandlerInterface
{

    public function __construct(
        private readonly BookRepository $bookRepository
    ) {
    }

    /**
     * Метод выполняет добавление автора
     */
    public function __invoke(UpdateBookQuery $updateBookQuery): Book
    {
        $id = $updateBookQuery->getId();
        $name = $updateBookQuery->getName();
        $isbn = $updateBookQuery->getIsbn();
        $numberPages = $updateBookQuery->getNumberPages();
        $yearPublishing = $updateBookQuery->getYearPublishing();

        $book = $this->bookRepository->findById($id);

        if (!isset($book)) {

            throw new \Exception('Такой книги не существует');

        }

        $book->setName($name);
        $book->setIsbn($isbn);
        $book->setNumberPages($numberPages);
        $book->setYearPublishing($yearPublishing);

        $this->bookRepository->persist($book);
        $this->bookRepository->flush();

        return $book;
    }
}
