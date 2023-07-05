<?php

namespace Itmo\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;
use Itmo\Domain\Base\Repository\AuthorRepositoryInterface;
use Itmo\Domain\Entity\Author;
use RuntimeException;
/**
 * @method Author|null find($id, $lockMode = null, $lockVersion = null)
 * @method Author|null findOneBy(array $criteria, array $orderBy = null)
 * @method Author[]    findAll()
 * @method Author[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorRepository extends ServiceEntityRepository implements AuthorRepositoryInterface
{
    private const ALIAS = 'author';

    public function __construct(
        ManagerRegistry $registry,
    ) {
        parent::__construct($registry, Author::class);
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findById(int $id): ?Author
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
        if (!$entity instanceof Author) {
            throw new RuntimeException('Entity must be ' . Author::class);
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
    public function isExistByFio(string $fio)
    {
        $alias = self::ALIAS;
        $qb = $this->createQueryBuilder($alias);
        $qb->select()
            ->where("{$alias}.fio = :fio")
            ->setParameter('fio', $fio)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }

}
