<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="Usuarios")
 * @ORM\Entity
 */
class Usuario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $apellidos;

    /**
     * @var integer
     *
     * @ORM\Column(name="telefono", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $telefono;


}

