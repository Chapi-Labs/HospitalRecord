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
     * @ORM\Column(name="codigo", type="string", length=5, nullable=true,unique=true)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="diagnostico", type="string", length=254, nullable=false)
     */
    private $diagnostico;

    /**
     * @ORM\OneToMany(
     *     targetEntity="AppBundle\Entity\IngresoPaciente",
     *     mappedBy="diagnosticoCie10"
     * )
     *
     * @var \Doctrine\Common\Collections\Collection
     */
    private $diagnosticos;

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
     * Set diagnostico.
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
     * Get diagnostico.
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
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->diagnosticos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add diagnostico.
     *
     * @param \AppBundle\Entity\IngresoPaciente $diagnostico
     *
     * @return Cie10
     */
    public function addDiagnostico(\AppBundle\Entity\IngresoPaciente $diagnostico)
    {
        $this->diagnosticos[] = $diagnostico;

        return $this;
    }

    /**
     * Remove diagnostico.
     *
     * @param \AppBundle\Entity\IngresoPaciente $diagnostico
     */
    public function removeDiagnostico(\AppBundle\Entity\IngresoPaciente $diagnostico)
    {
        $this->diagnosticos->removeElement($diagnostico);
    }

    /**
     * Get diagnosticos.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDiagnosticos()
    {
        return $this->diagnosticos;
    }
}
