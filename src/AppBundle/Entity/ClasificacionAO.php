<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * ClasificacionAO.
 *
 * @ORM\Table()
 * @ORM\Entity
 * @UniqueEntity("identificadorAO")
 */
class ClasificacionAO
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
     * @ORM\Column(name="identificadorAO", type="string", length=255,unique=true)
     */
    private $identificadorAO;

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
     * Set identificadorAO.
     *
     * @param string $identificadorAO
     *
     * @return ClasificacionAO
     */
    public function setIdentificadorAO($identificadorAO)
    {
        $this->identificadorAO = $identificadorAO;

        return $this;
    }

    /**
     * Get identificadorAO.
     *
     * @return string
     */
    public function getIdentificadorAO()
    {
        return $this->identificadorAO;
    }

    public function __toString()
    {
        return $this->identificadorAO;
    }
}
