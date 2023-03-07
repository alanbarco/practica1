<?php

namespace App\Entity;

use App\Repository\RegistroRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RegistroRepository::class)
 */
class Registro
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_curso;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCurso(): ?int
    {
        return $this->id_curso;
    }

    public function setIdCurso(int $id_curso): self
    {
        $this->id_curso = $id_curso;

        return $this;
    }

    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    public function setIdUser(int $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }
}
