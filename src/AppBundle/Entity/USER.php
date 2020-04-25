<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; 
/**
 * USER
 *
 * @ORM\Table(name="u_s_e_r")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\USERRepository")
 */
class USER
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
     *@Assert\NotBlank()
     * @ORM\Column(name="EMPID", type="string", length=5, unique=true)
     */
    private $eMPID;

    /**
     * @var string
     *
     * @ORM\Column(name="NAME", type="string", length=30)
     */
    private $nAME;

    /**
     * @var string
     *
     * @ORM\Column(name="EMAIL", type="string", length=30)
     */
    private $eMAIL;

    /**
     * @var string
     *
     * @ORM\Column(name="PASSWORD", type="string", length=30)
     */
    private $pASSWORD;

    /**
     * @var int
     *
     * @ORM\Column(name="EXPERIENCE", type="integer")
     */
    private $eXPERIENCE;

    /**
     * @var string
     *
     * @ORM\Column(name="GENDER", type="string", length=20)
     */
    private $gENDER;

    /**
     * @var string
     *
     * @ORM\Column(name="ADDRESS", type="string", length=60)
     */
    private $aDDRESS;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set eMPID
     *
     * @param string $eMPID
     *
     * @return USER
     */
    public function setEMPID($eMPID)
    {
        $this->eMPID = $eMPID;

        return $this;
    }

    /**
     * Get eMPID
     *
     * @return string
     */
    public function getEMPID()
    {
        return $this->eMPID;
    }

    /**
     * Set nAME
     *
     * @param string $nAME
     *
     * @return USER
     */
    public function setNAME($nAME)
    {
        $this->nAME = $nAME;

        return $this;
    }

    /**
     * Get nAME
     *
     * @return string
     */
    public function getNAME()
    {
        return $this->nAME;
    }

    /**
     * Set eMAIL
     *
     * @param string $eMAIL
     *
     * @return USER
     */
    public function setEMAIL($eMAIL)
    {
        $this->eMAIL = $eMAIL;

        return $this;
    }

    /**
     * Get eMAIL
     *
     * @return string
     */
    public function getEMAIL()
    {
        return $this->eMAIL;
    }

    /**
     * Set pASSWORD
     *
     * @param string $pASSWORD
     *
     * @return USER
     */
    public function setPASSWORD($pASSWORD)
    {
        $this->pASSWORD = $pASSWORD;

        return $this;
    }

    /**
     * Get pASSWORD
     *
     * @return string
     */
    public function getPASSWORD()
    {
        return $this->pASSWORD;
    }

    /**
     * Set eXPERIENCE
     *
     * @param integer $eXPERIENCE
     *
     * @return USER
     */
    public function setEXPERIENCE($eXPERIENCE)
    {
        $this->eXPERIENCE = $eXPERIENCE;

        return $this;
    }

    /**
     * Get eXPERIENCE
     *
     * @return int
     */
    public function getEXPERIENCE()
    {
        return $this->eXPERIENCE;
    }

    /**
     * Set gENDER
     *
     * @param string $gENDER
     *
     * @return USER
     */
    public function setGENDER($gENDER)
    {
        $this->gENDER = $gENDER;

        return $this;
    }

    /**
     * Get gENDER
     *
     * @return string
     */
    public function getGENDER()
    {
        return $this->gENDER;
    }

    /**
     * Set aDDRESS
     *
     * @param string $aDDRESS
     *
     * @return USER
     */
    public function setADDRESS($aDDRESS)
    {
        $this->aDDRESS = $aDDRESS;

        return $this;
    }

    /**
     * Get aDDRESS
     *
     * @return string
     */
    public function getADDRESS()
    {
        return $this->aDDRESS;
    }
}

