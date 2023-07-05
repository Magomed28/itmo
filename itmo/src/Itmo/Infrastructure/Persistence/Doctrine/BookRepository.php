<?php

namespace Itmo\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;
use Itmo\Domain\Base\Repository\BookRepositoryInterface;
use Itmo\Domain\Entity\Book;
use RuntimeException;
/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository implements BookRepositoryInterface
{
    private const ALIAS = 'book';

    public function __construct(
        ManagerRegistry $registry,
    ) {
        parent::__construct($registry, Book::class);
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findById(int $id): ?Book
    {
        $alias = self::ALIAS;
        $qb = $this->createQueryBuilder($alias);
        $qb->select()
            ->where("{$alias}.id = :id")
            ->setParameter('id', $id)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function persist($entity)
    {
        if (!$entity instanceof Book) {
            throw new RuntimeException('Entity must be ' . Book::class);
        }
        $this->_em->persist($entity);
    }

    public function flush()
    {
        $this->_em->flush();
    }

    public function removeById(int $id)
    {
        $alias = self::ALIAS;
        $qb = $this->createQueryBuilder($alias);
        $query = $qb->delete()
            ->where("{$alias}.id = :id")
            ->setParameter('id', $id)
            ->getQuery()
        ;

        return $query->execute();
    }

    /**
     * @throws NonUniqueResultException
     */
    public function isExistByNameAndIsbn(string $name, string $isbn)
    {
        $alias = self::ALIAS;
        $qb = $this->createQueryBuilder($alias);
        $qb->select()
            ->where("{$alias}.name = :bookName")
            ->andWhere("{$alias}.isbn = :isbn")
            ->setParameter('bookName', $name)
            ->setParameter('isbn', $isbn)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }

}
