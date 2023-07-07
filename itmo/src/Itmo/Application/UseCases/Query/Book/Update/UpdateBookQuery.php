<?php

namespace Itmo\Application\UseCases\Query\Book\Update;

use Itmo\Application\UseCases\Query\QueryInterface;

class UpdateBookQuery implements QueryInterface
{
    public function __construct(
        private readonly int $id,
        private readonly string $name,
        private readonly string $isbn,
        private readonly int $numberPages,
        private readonly int $yearPublishing,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function getNumberPages(): string
    {
        return $this->numberPages;
    }

    public function getYearPublishing(): string
    {
        return $this->yearPublishing;
    }
}
