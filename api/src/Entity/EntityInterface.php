<?php

/**
 * Интерфес заглушка, для коректного определения типа данных
 * PHP version 7.4.1.
 *
 * @category Application
 *
 * @author  sanerrus <username@example.com>
 * @license MIT http://www.example.com/License.txt
 *
 * @see http://www.example.com/Document.txt
 */

namespace App\Entity;

/**
 * Интерфейс необходимых методов в сущностях.
 * Так же служит для проверки типа данных
 * Interface EntityInterface
 * @package App\Entity
 */
interface EntityInterface
{
    /**
     * Возвращаем данные в виде массива.
     */
    public function toArray(): iterable;
}
