<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClasificacionAO
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ClasificacionAO
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
     * @ORM\Column(name="identificadorAO", type="string", length=255)
     */
    private $identificadorAO;


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
     * Set identificadorAO
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
     * Get identificadorAO
     *
     * @return string
     */
    public function getIdentificadorAO()
    {
        return $this->identificadorAO;
    }
}

