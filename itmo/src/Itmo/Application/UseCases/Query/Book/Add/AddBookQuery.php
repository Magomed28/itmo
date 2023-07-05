<?php

namespace Itmo\Application\UseCases\Query\Book\Add;

use Itmo\Application\UseCases\Query\QueryInterface;

class AddBookQuery implements QueryInterface
{
    public function __construct(
        private readonly string $name,
        private readonly string $isbn,
        private readonly string $numberPages,
        private readonly string $yearPublishing,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function getNumberPages(): int
    {
        return $this->numberPages;
    }

    public function getYearPublishing(): string
    {
        return $this->yearPublishing;
    }
}
