<?php

namespace Itmo\Application\UseCases\Query\Author\Update;

use Itmo\Application\UseCases\Query\QueryHandlerInterface;
use Itmo\Domain\Entity\Author;
use Itmo\Infrastructure\Persistence\Doctrine\AuthorRepository;

class UpdateAuthorHandler implements QueryHandlerInterface
{

    public function __construct(
        private readonly AuthorRepository $authorRepository
    ) {
    }

    /**
     * Метод выполняет добавление автора
     */
    public function __invoke(UpdateAuthorQuery $updateAuthorQuery): Author
    {
        $id = $updateAuthorQuery->getId();
        $fio = $updateAuthorQuery->getFio();

        $author = $this->authorRepository->findById($id);

        if (!isset($author)) {

            throw new \Exception('Такого автора не существует');

        }

        $author->setFio($fio);
        $this->authorRepository->persist($author);
        $this->authorRepository->flush();

        return $author;
    }
}
