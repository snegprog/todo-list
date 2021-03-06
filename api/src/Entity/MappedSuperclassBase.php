<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Базовый класс сущностей.
 * Указаны необходимые поля для всех сущностей.
 * @ORM\MappedSuperclass
 */
class MappedSuperclassBase
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
