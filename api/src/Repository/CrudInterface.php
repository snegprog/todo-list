<?php

/**
 * Интерфейс CRUD задач
 * PHP version 7.4.1.
 *
 * @category Application
 *
 * @author  sanerrus <username@example.com>
 * @license MIT http://www.example.com/License.txt
 *
 * @see http://www.example.com/Document.txt
 */

namespace App\Repository;

use App\Entity\EntityInterface;

interface CrudInterface
{
    /**
     * Добавляем сущность в БД.
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \InvalidArgumentException
     */
    public function create(EntityInterface $entity): EntityInterface;

    /**
     * Обновляем сущность в БД.
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \InvalidArgumentException
     */
    public function update(EntityInterface $entity): EntityInterface;

    /**
     * Удаляем сущность из БД.
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \InvalidArgumentException
     */
    public function remove(EntityInterface $entity): EntityInterface;
}
