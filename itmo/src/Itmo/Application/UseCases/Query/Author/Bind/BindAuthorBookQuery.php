<?php

namespace Itmo\Application\UseCases\Query\Author\Bind;

use Itmo\Application\UseCases\Query\QueryInterface;

class BindAuthorBookQuery implements QueryInterface
{
    public function __construct(
        private readonly int $authorId,
        private readonly int $bookId,
    ) {
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    public function getBookId(): int
    {
        return $this->bookId;
    }

}
