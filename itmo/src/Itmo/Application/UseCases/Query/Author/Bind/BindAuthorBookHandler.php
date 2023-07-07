<?php

namespace Itmo\Application\UseCases\Query\Author\Bind;

use Itmo\Application\UseCases\Query\QueryHandlerInterface;
use Itmo\Domain\Entity\Author;
use Itmo\Infrastructure\Persistence\Doctrine\AuthorRepository;
use Itmo\Infrastructure\Persistence\Doctrine\BookRepository;

class BindAuthorBookHandler implements QueryHandlerInterface
{

    public function __construct(
        private readonly AuthorRepository $authorRepository,
        private readonly BookRepository $bookRepository
    ) {
    }

    /**
     * Метод выполняет добавление автора
     */
    public function __invoke(BindAuthorBookQuery $bindAuthorBookQuery): Author
    {
        $authorId = $bindAuthorBookQuery->getAuthorId();

        $bookId = $bindAuthorBookQuery->getBookId();

        $author = $this->authorRepository->findById($authorId);

        $book = $this->bookRepository->findById($bookId);

        if (!isset($author)) {

            throw new \Exception('Такого автора не существует');

        }

        if (!isset($book)) {

            throw new \Exception('Такой книги не существует');

        }

        $author->setBook($book);
        $book->setAuthor($author);
        $this->authorRepository->persist($author);
        $this->bookRepository->persist($book);
        $this->authorRepository->flush();
        $this->bookRepository->flush();

        return $author;
    }
}
