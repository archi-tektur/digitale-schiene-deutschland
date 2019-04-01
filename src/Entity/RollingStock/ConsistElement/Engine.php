<?php

namespace App\Entity\RollingStock\ConsistElement;

use App\Entity\Consist;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EngineRepository")
 */
class Engine
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\RollingStock\Consist", mappedBy="engines")
     */
    private $consists;

    public function __construct()
    {
        $this->consists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|\App\Entity\RollingStock\Consist[]
     */
    public function getConsists(): Collection
    {
        return $this->consists;
    }

    public function addConsist(\App\Entity\RollingStock\Consist $consist): self
    {
        if (!$this->consists->contains($consist)) {
            $this->consists[] = $consist;
            $consist->addEngine($this);
        }

        return $this;
    }

    public function removeConsist(\App\Entity\RollingStock\Consist $consist): self
    {
        if ($this->consists->contains($consist)) {
            $this->consists->removeElement($consist);
            $consist->removeEngine($this);
        }

        return $this;
    }
}
