<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Procedimiento.
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Procedimiento
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
     * @ORM\Column(name="descripcionProcedimiento", type="text")
     */
    private $descripcionProcedimiento;

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
     * Set descripcionProcedimiento.
     *
     * @param string $descripcionProcedimiento
     *
     * @return Procedimiento
     */
    public function setDescripcionProcedimiento($descripcionProcedimiento)
    {
        $this->descripcionProcedimiento = $descripcionProcedimiento;

        return $this;
    }

    /**
     * Get descripcionProcedimiento.
     *
     * @return string
     */
    public function getDescripcionProcedimiento()
    {
        return $this->descripcionProcedimiento;
    }

    public function __toString()
    {
        return $this->descripcionProcedimiento;
    }
}
