<?php

namespace Devzone\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class SuperMaster
 * @package Devzone\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="supermasters")
 * @UniqueEntity({"ip", "nameserver"})
 */
class SuperMaster
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $ip;

    /**
     * @ORM\Column(type="string", name="nameserver")
     */
    private $nameServer;

    /**
     * @ORM\Column(type="string", length=40)
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
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * @return string
     */
    public function getNameServer()
    {
        return $this->nameServer;
    }

    /**
     * @param string $nameServer
     */
    public function setNameServer($nameServer)
    {
        $this->nameServer = $nameServer;
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
