<?php

/**
 * Интерфейс недостающих методов в репозитории
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

interface RepositoryInterface
{
    /**
     * Возвращать массив с ключами по указанному полю.
     * @param string $key - поле которое будет ключем возвращаемого массива
     * @return null|array <int|string, EntityInterface>
     */
    public function getAllWithSpecifiedKey(string $key = 'id'): ?iterable;
}
