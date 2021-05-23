<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
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

    public function getCreateAt(): \DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getUpdateAt(): \DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeInterface $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * @ORM\PreUpdate
     */
    public function updatedTimestamps(): void
    {
        $this->setUpdateAt(new \DateTime());
    }

    /**
     * @ORM\PrePersist
     */
    public function createTimestamps(): void
    {
        $this->setCreateAt(new \DateTime());
        $this->setUpdateAt(new \DateTime());
    }
}
