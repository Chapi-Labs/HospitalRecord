<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
//sirve para extender de friendofsymfony
use FOS\UserBundle\Entity\User as BaseUser;

//sirve para validar los campos del formulario

/**
 * @ORM\Table(name="Usuarios")
 * @ORM\Entity
 */
class Usuario extends BaseUser
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;

    /**
     * @var string
     * @ORM\Column(name="apellidos", type="string", length=100)
     */
    private $apellidos;

    /**
     * @var int
     * @ORM\Column(name="telefono", type="integer")
     */
    private $telefono;
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();// construye los metodos y atributos de Base
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
     * Get expiresAt.
     *
     * @return \DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * Get credentials_expire_at.
     *
     * @return \DateTime
     */
    public function getCredentialsExpireAt()
    {
        return $this->credentialsExpireAt;
    }

    public function hasRole($role)
    {
        if (in_array($role, $this->getRoles())) {
            return true;
        }

        return false;
    }

    /**
     * Set nombre.
     *
     * @param string $nombre
     *
     * @return Usuario
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre.
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellidos.
     *
     * @param string $apellidos
     *
     * @return Usuario
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos.
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set telefono.
     *
     * @param int $telefono
     *
     * @return Usuario
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono.
     *
     * @return int
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    public function __toString()
    {
        return $this->nombre.' '.$this->apellidos;
    }
}
