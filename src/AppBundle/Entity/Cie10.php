<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cie10.
 *
 * @ORM\Table(name="cie10")
 * @ORM\Entity
 */
class Cie10
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=5, nullable=false,unique=true)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="diagnostico", type="string", length=254, nullable=false)
     */
    private $diagnostico;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set codigo.
     *
     * @param string $codigo
     *
     * @return Cie10
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo.
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

   
    /**
     * Set diagnostico
     *
     * @param string $diagnostico
     *
     * @return Cie10
     */
    public function setDiagnostico($diagnostico)
    {
        $this->diagnostico = $diagnostico;

        return $this;
    }

    /**
     * Get diagnostico
     *
     * @return string
     */
    public function getDiagnostico()
    {
        return $this->diagnostico;
    }

     /**
     * @return string Mostrar enfermedad
     */
    public function __toString()
    {
        return $this->diagnostico;
    }
}
