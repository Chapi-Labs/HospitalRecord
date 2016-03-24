<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Diagnostico.
 *
 * @ORM\Table()
 * @ORM\Entity
 *  @UniqueEntity("nombreDiagnostico")
 */
class Diagnostico
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreDiagnostico", type="string", length=255)
     */
    private $nombreDiagnostico;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\IngresoPaciente", mappedBy="diagnosticos")
     */
    private $ingresos;

    public function __construct()
    {
        $this->ingresos =  new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set nombreDiagnostico.
     *
     * @param string $nombreDiagnostico
     *
     * @return Diagnostico
     */
    public function setNombreDiagnostico($nombreDiagnostico)
    {
        $this->nombreDiagnostico = $nombreDiagnostico;

        return $this;
    }

    /**
     * Get nombreDiagnostico.
     *
     * @return string
     */
    public function getNombreDiagnostico()
    {
        return $this->nombreDiagnostico;
    }

    public function __toString()
    {
        return $this->nombreDiagnostico;
    }

    /**
     * Set ingreso.
     *
     * @param \AppBundle\Entity\IngresoPaciente $ingreso
     *
     * @return Diagnostico
     */
    public function setIngreso(\AppBundle\Entity\IngresoPaciente $ingreso = null)
    {
        $this->ingreso = $ingreso;

        return $this;
    }

    /**
     * Get ingreso.
     *
     * @return \AppBundle\Entity\IngresoPaciente
     */
    public function getIngreso()
    {
        return $this->ingreso;
    }

    /**
     * Add ingreso
     *
     * @param \AppBundle\Entity\IngresoPaciente $ingreso
     *
     * @return Diagnostico
     */
    public function addIngreso(\AppBundle\Entity\IngresoPaciente $ingreso)
    {
        $this->ingresos[] = $ingreso;

        return $this;
    }

    /**
     * Remove ingreso
     *
     * @param \AppBundle\Entity\IngresoPaciente $ingreso
     */
    public function removeIngreso(\AppBundle\Entity\IngresoPaciente $ingreso)
    {
        $this->ingresos->removeElement($ingreso);
    }

    /**
     * Get ingresos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIngresos()
    {
        return $this->ingresos;
    }
}
