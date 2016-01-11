<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Paciente.
 *
 * @ORM\Table()
 * @ORM\Entity
 * @UniqueEntity("dpi")
 * @UniqueEntity("expediente")
 */
class Paciente
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
     * @ORM\Column(name="expediente", type="string", length=255,unique=true)
     */
    private $expediente;

    /**
     * @var int
     *
     * @ORM\Column(name="dpi", type="string",length=13, unique=true,nullable=true)
     * 
     * @Assert\Length(
     *      min = 13,
     *      max = 13,
     *      minMessage = "El DPI tiene que ser de {{ limit }} dígitos",
     *      maxMessage = "El DPI tiene que ser de {{ limit }} dígitos"
     * )
     */
    private $dpi;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    public $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=100)
     */
    public $apellidos;

    /**
     * @var int
     *
     * @ORM\Column(name="telefono", type="integer",nullable=true)
     * @Assert\Length(
     *      min = 8,
     *      max = 8,
     *      minMessage = "El teléfono tiene que ser de 8 dígitos",
     *      maxMessage = "El teléfono tiene que ser de 8 dígitos"
     * )
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255,nullable=true)
     */
    private $direccion;

    /**
     * @var int
     *
     * @ORM\Column(name="edad", type="integer")
     * @Assert\Length(
     *      min = 1,
     *      max = 2,
     *      minMessage = "La  edad tiene que ser de {{ limit }} dígitos",
     *      maxMessage = "La edad tiene que ser de {{ limit }} dígitos"
     * )
     */
    private $edad;

    /**
     * @var string
     *             Masculino o Femenino
     * @ORM\Column(name="genero", type="string", length=20)
     */
    private $genero;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Usuario")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id",onDelete="SET NULL")
     */
    private $usuario;

    /**
     * @Gedmo\Slug(fields={"nombre", "apellidos"},updatable=true)
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * @var string
     *
     * @ORM\Column(name="content_changed_by", type="string", nullable=true)
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Usuario")
     * @Gedmo\Blameable(on="change", field={"nombre", "apellidos","edad","genero","dpi","telefono","direccion"})
     */
    private $contentChangedBy;

    /**
     * @ORM\OneToMany(
     *     targetEntity="AppBundle\Entity\IngresoPaciente",
     *     mappedBy="paciente"
     * )
     *
     * @var \Doctrine\Common\Collections\Collection
     */
    private $ingreso;

    public function __construct()
    {
        $this->ingreso = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set dpi.
     *
     * @param int $dpi
     *
     * @return Paciente
     */
    public function setDpi($dpi)
    {
        $this->dpi = $dpi;

        return $this;
    }

    /**
     * Get dpi.
     *
     * @return int
     */
    public function getDpi()
    {
        return $this->dpi;
    }

    /**
     * Set nombre.
     *
     * @param string $nombre
     *
     * @return Paciente
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
     * @return Paciente
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
     * @return Paciente
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

    /**
     * Set direccion.
     *
     * @param string $direccion
     *
     * @return Paciente
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion.
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set edad.
     *
     * @param int $edad
     *
     * @return Paciente
     */
    public function setEdad($edad)
    {
        $this->edad = $edad;

        return $this;
    }

    /**
     * Get edad.
     *
     * @return int
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * Set genero.
     *
     * @param string $genero
     *
     * @return Paciente
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * Get genero.
     *
     * @return string
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Set slug.
     *
     * @param string $slug
     *
     * @return Curso
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set created.
     *
     * @param \DateTime $created
     *
     * @return Paciente
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Set updated.
     *
     * @param \DateTime $updated
     *
     * @return Paciente
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Set usuario.
     *
     * @param \UserBundle\Entity\Usuario $usuario
     *
     * @return Paciente
     */
    public function setUsuario(\UserBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario.
     *
     * @return \UserBundle\Entity\Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * El método es llamado para mostrar los dos atributos en el select2.
     *
     * @return string obtener el nombre y el apellido en un solo método .
     */
    public function getDpiNombreApellido()
    {
        return sprintf(
            '%s - %s %s',
            $this->getDpi(),
            $this->getNombre(),
            $this->getApellidos()
        );
    }

    /**
     * Add ingreso.
     *
     * @param \AppBundle\Entity\IngresoPaciente $ingreso
     *
     * @return Paciente
     */
    public function addIngreso(\AppBundle\Entity\IngresoPaciente $ingreso)
    {
        $this->ingreso[] = $ingreso;

        return $this;
    }

    /**
     * Remove ingreso.
     *
     * @param \AppBundle\Entity\IngresoPaciente $ingreso
     */
    public function removeIngreso(\AppBundle\Entity\IngresoPaciente $ingreso)
    {
        $this->ingreso->removeElement($ingreso);
    }

    /**
     * Get ingreso.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIngreso()
    {
        return $this->ingreso;
    }

    /**
     * Set contentChangedBy.
     *
     * @param string $contentChangedBy
     *
     * @return Paciente
     */
    public function setContentChangedBy($contentChangedBy)
    {
        $this->contentChangedBy = $contentChangedBy;

        return $this;
    }

    /**
     * Get contentChangedBy.
     *
     * @return string
     */
    public function getContentChangedBy()
    {
        return $this->contentChangedBy;
    }

    /**
     * Set expediente.
     *
     * @param string $expediente
     *
     * @return Paciente
     */
    public function setExpediente($expediente)
    {
        $this->expediente = $expediente;

        return $this;
    }

    /**
     * Get expediente.
     *
     * @return string
     */
    public function getExpediente()
    {
        return $this->expediente;
    }

    public function __toString()
    {
        return $this->nombre.' '.$this->apellidos;
    }
}
