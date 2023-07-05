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
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\Table;
use JetBrains\PhpStorm\Pure;
use JsonSerializable;
use Symfony\Component\Validator\Constraints as Assert;

#[Entity]
#[Table(name: 'book')]
class Book implements JsonSerializable
{
    #[Id]
    #[GeneratedValue()]
    #[Column(type: Types::INTEGER)]
    private int $id;

    /**
     * Название книги
     */
    #[Assert\NotBlank]
    #[Column(type: Types::STRING)]
    private string $name;

    /**
     * ISBN
     */
    #[Assert\NotBlank]
    #[Column(type: Types::STRING)]
    private string $isbn;

    /**
     * Количество страниц
     */
    #[Assert\NotBlank]
    #[Column(type: Types::INTEGER)]
    private int $numberPages;

    /**
     * Количество страниц
     */
    #[Assert\NotBlank]
    #[Column(type: Types::INTEGER)]
    private int $yearPublishing;

    /**
     * Many Groups have Many Users.
     * @var Collection<int, Author>
     */
    #[ManyToMany(targetEntity: Author::class, mappedBy: 'books')]
    private Collection $authors;

    #[Pure]
    public function __construct() {
        $this->authors = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Book
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Book
    {
        $this->name = $name;

        return $this;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): Book
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getNumberPage(): int
    {
        return $this->numberPages;
    }

    public function setNumberPages(int $numberPages): Book
    {
        $this->numberPages = $numberPages;

        return $this;
    }

    public function getYearPublishing(): int
    {
        return $this->yearPublishing;
    }

    public function setYearPublishing(int $yearPublishing): Book
    {
        $this->yearPublishing = $yearPublishing;

        return $this;
    }

    public function getAuthors(): Collection
    {
        return $this->authors;
    }

    public function setAuthors(Collection $authors): Book
    {
        $this->authors = $authors;

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
            'name' => $this->getName(),
            'numberPage' => $this->getNumberPage(),
            'isbn' => $this->getIsbn(),
            'yearPublishing' => $this->getYearPublishing()
        ];
    }
}
