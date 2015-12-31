<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PreDiagnostico
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PreDiagnostico
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
     * @ORM\ManyToOne(targetEntity="Diagnostico")
     */
    private $preDiagnostico;


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
     * Set preDiagnostico
     *
     * @param \AppBundle\Entity\Diagnostico $preDiagnostico
     *
     * @return PreDiagnostico
     */
    public function setPreDiagnostico(\AppBundle\Entity\Diagnostico $preDiagnostico = null)
    {
        $this->preDiagnostico = $preDiagnostico;

        return $this;
    }

    /**
     * Get preDiagnostico
     *
     * @return \AppBundle\Entity\Diagnostico
     */
    public function getPreDiagnostico()
    {
        return $this->preDiagnostico;
    }

    public function __toString()
    {
        return $this->preDiagnostico->__toString();
    }

}
