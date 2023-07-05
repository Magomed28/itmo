<?php

namespace Itmo\Application\UseCases\Query\Book\Add;

use Itmo\Application\UseCases\Query\QueryHandlerInterface;
use Itmo\Domain\Entity\Book;
use Itmo\Infrastructure\Persistence\Doctrine\BookRepository;

class AddBookHandler implements QueryHandlerInterface
{

    public function __construct(
        private readonly BookRepository $bookRepository
    ) {
    }

    /**
     * Метод выполняет добавление книг
     */
    public function __invoke(AddBookQuery $addBookQuery): Book
    {
        $name = $addBookQuery->getName();

        $isbn = $addBookQuery->getIsbn();

        $numberPages = $addBookQuery->getNumberPages();

        $yearPublishing = $addBookQuery->getYearPublishing();

        $bookExist = $this->bookRepository->isExistByNameAndIsbn($name,$isbn);

        if ($bookExist) {

            throw new \Exception('Такая книга уже существует');

        }

        $book = new Book();
        $book->setName($name);
        $book->setIsbn($isbn);
        $book->setNumberPages($numberPages);
        $book->setYearPublishing($yearPublishing);
        $this->bookRepository->persist($book);
        $this->bookRepository->flush();

        return $book;
    }
}
