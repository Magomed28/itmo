<?php

namespace Itmo\Domain\Base\Repository;

interface BookRepositoryInterface
{

    public function findById(int $id);

    public function persist($entity);

    public function flush();

    public function removeById(int $id);

    public function findAll();

    public  function isExistByNameAndIsbn(string $name, string $isbn);

}
