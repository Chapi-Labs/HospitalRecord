<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Diagnostico
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Diagnostico
{
    /**
     * @var integer
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombreDiagnostico
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
     * Get nombreDiagnostico
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
     * Set ingreso
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
     * Get ingreso
     *
     * @return \AppBundle\Entity\IngresoPaciente
     */
    public function getIngreso()
    {
        return $this->ingreso;
    }
}
