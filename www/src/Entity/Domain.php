<?php

namespace Devzone\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class Domain
 * @package Devzone\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="domains")
 * @UniqueEntity("name")
 */
class Domain
{

    use Traits\DomainExtraTrait;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $master;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $lastCheck;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $notifiedSerial;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $account;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getMaster()
    {
        return $this->master;
    }

    /**
     * @param string $master
     */
    public function setMaster($master)
    {
        $this->master = $master;
    }

    /**
     * @return int
     */
    public function getLastCheck()
    {
        return $this->lastCheck;
    }

    /**
     * @param int $lastCheck
     */
    public function setLastCheck($lastCheck)
    {
        $this->lastCheck = $lastCheck;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getNotifiedSerial()
    {
        return $this->notifiedSerial;
    }

    /**
     * @param int $notifiedSerial
     */
    public function setNotifiedSerial($notifiedSerial)
    {
        $this->notifiedSerial = $notifiedSerial;
    }

    /**
     * @return string
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param string $account
     */
    public function setAccount($account)
    {
        $this->account = $account;
    }

}
