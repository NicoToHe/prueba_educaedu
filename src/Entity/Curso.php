<?php

namespace App\Entity;

use App\Repository\CursoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CursoRepository::class)]
class Curso
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descripcion = null;

    #[ORM\Column]
    private ?float $precio = null;

    #[ORM\OneToMany(mappedBy: 'curso', targetEntity: Opinion::class)]
    private Collection $opiniones;

    public function __construct()
    {
        $this->opiniones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): static
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): static
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * @return Collection<int, Opinion>
     */
    public function getOpiniones(): Collection
    {
        return $this->opiniones;
    }

    public function addOpinion(Opinion $opinion): static
    {
        if (!$this->opiniones->contains($opinion)) {
            $this->opiniones->add($opinion);
            $opinion->setCurso($this);
        }

        return $this;
    }

    public function removeOpinion(Opinion $opinion): static
    {
        if ($this->opiniones->removeElement($opinion)) {
            // set the owning side to null (unless already changed)
            if ($opinion->getCurso() === $this) {
                $opinion->setCurso(null);
            }
        }

        return $this;
    }

    public function getIsTop(): bool
    {
        $opiniones = $this->getOpiniones();
        if(count($opiniones) === 0) return false;

        $total = $opiniones->reduce(function (int $acc, Opinion $opinion){
            return $acc + $opinion->getValoracion();
        }, 0);

        return ($total/count($opiniones)) === 5;
    }
}
