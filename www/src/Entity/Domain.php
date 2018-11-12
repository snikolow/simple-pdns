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
     * @ORM\Column(type="string")
     */
    private $primaryRecord;

    /**
     * @ORM\Column(type="integer")
     */
    private $refresh = 3600;

    /**
     * @ORM\Column(type="integer")
     */
    private $expire = 604800;

    /**
     * @ORM\Column(type="integer")
     */
    private $retry = 900;

    /**
     * @ORM\Column(type="integer")
     */
    private $ttl = 86400;

    /**
     * @ORM\Column(type="string")
     */
    private $email;

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

    /**
     * @return string
     */
    public function getPrimaryRecord()
    {
        return $this->primaryRecord;
    }

    /**
     * @param string $primary
     */
    public function setPrimaryRecord(string $primary)
    {
        $this->primaryRecord = $primary;
    }

    /**
     * @return int
     */
    public function getRefresh()
    {
        return $this->refresh;
    }

    /**
     * @param int $refresh
     */
    public function setRefresh(int $refresh)
    {
        $this->refresh = $refresh;
    }

    /**
     * @return int
     */
    public function getExpire()
    {
        return $this->expire;
    }

    /**
     * @param int $expire
     */
    public function setExpire(int $expire)
    {
        $this->expire = $expire;
    }

    /**
     * @return int
     */
    public function getRetry()
    {
        return $this->retry;
    }

    /**
     * @param int $retry
     */
    public function setRetry(int $retry)
    {
        $this->retry = $retry;
    }

    /**
     * @return mixed
     */
    public function getTtl()
    {
        return $this->ttl;
    }

    /**
     * @param mixed $ttl
     */
    public function setTtl($ttl)
    {
        $this->ttl = $ttl;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

}
