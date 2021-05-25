<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Класс сущностей для которых необходимы поля дат создания и обновления
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks
 */
class MappedSuperclassDate extends MappedSuperclassBase
{
    /**
     * @var \DateTimeInterface
     *
     * @ORM\Column(name="create_at", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createAt;

    /**
     * @var \DateTimeInterface
     *
     * @ORM\Column(name="update_at", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $updateAt;

    /**
     * Возвращаем дату создания записи
     * @return \DateTimeInterface
     */
    public function getCreateAt(): \DateTimeInterface
    {
        return empty($this->createAt) ? new \DateTime(): $this->createAt;
    }

    /**
     * Устанавливаем дату создания записи
     * @param \DateTimeInterface $createAt
     * @return $this
     */
    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * Возвращаем дату обновления записи
     * @return \DateTimeInterface
     */
    public function getUpdateAt(): \DateTimeInterface
    {
        return empty($this->updateAt) ? new \DateTime(): $this->updateAt;
    }

    /**
     * Устанавливаем дату обновления записи
     * @param \DateTimeInterface $updateAt
     * @return $this
     */
    public function setUpdateAt(\DateTimeInterface $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * Действие при обновлении существующей записи
     * @ORM\PreUpdate
     */
    public function updatedTimestamps(): void
    {
        $this->setUpdateAt(new \DateTime());
    }

    /**
     * Действие при создание записи
     * @ORM\PrePersist
     */
    public function createTimestamps(): void
    {
        $this->setCreateAt(new \DateTime());
        $this->setUpdateAt(new \DateTime());
    }
}
