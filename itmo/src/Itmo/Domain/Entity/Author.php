<?php

declare(strict_types=1);

namespace Itmo\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\InverseJoinColumn;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\Table;
use JetBrains\PhpStorm\Pure;
use JsonSerializable;
use Symfony\Component\Validator\Constraints as Assert;

#[Entity]
#[Table(name: 'author')]
class Author implements JsonSerializable
{
    #[Id]
    #[GeneratedValue()]
    #[Column(type: Types::INTEGER)]
    private int $id;

    /**
     * ФИО
     */
    #[Assert\NotBlank]
    #[Column(type: Types::STRING)]
    private string $fio;

    #[JoinTable(name: 'author_book')]
    #[JoinColumn(name: 'author_id', referencedColumnName: 'id')]
    #[InverseJoinColumn(name: 'book_id', referencedColumnName: 'id')]
    #[ManyToMany(targetEntity: Book::class)]
    private Collection $books;

    #[Pure]
    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Author
    {
        $this->id = $id;

        return $this;
    }

    public function getFio(): string
    {
        return $this->fio;
    }

    public function setFio(string $fio): Author
    {
        $this->fio = $fio;

        return $this;
    }

    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function setBook(Book $book): Author
    {
        $this->books->add($book);

        return $this;
    }

    public function removeBook(Book $book): Author
    {
        $book->getAuthors()->removeElement($this);
        $this->books->removeElement($book);

        return $this;
    }

    public function __toString(): string
    {
        return json_encode($this->jsonSerialize(),JSON_PRETTY_PRINT);
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'fio' => $this->getFio(),
            'books' => $this->getBooks()->getValues()
        ];
    }
}
