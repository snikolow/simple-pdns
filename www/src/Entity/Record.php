<?php

namespace Devzone\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;

/**
 * Class Record
 * @package Devzone\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(
 *     name="records",
 *     indexes={
 *      @Index(columns={"name", "type"}),
 *      @Index(columns={"domain_id"}),
 *      @Index(columns={"domain_id", "ordername"})
 *     }
 * )
 */
class Record
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Devzone\Entity\Domain")
     * @ORM\JoinColumn(name="domain_id", referencedColumnName="id", nullable=true)
     */
    private $domain;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ttl;

    /**
     * @ORM\Column(type="integer", name="prio", nullable=true)
     */
    private $priority;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $changeDate;

    /**
     * @ORM\Column(type="boolean", options={"default": "0"})
     */
    private $disabled = false;

    /**
     * @ORM\Column(type="binary", name="ordername", nullable=true)
     */
    private $orderName;

    /**
     * @ORM\Column(type="boolean", options={"default": "1"})
     */
    private $auth = true;

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
     * @return \Devzone\Entity\Domain
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param \Devzone\Entity\Domain $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
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
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return int
     */
    public function getTtl()
    {
        return $this->ttl;
    }

    /**
     * @param int $ttl
     */
    public function setTtl($ttl)
    {
        $this->ttl = $ttl;
    }

    /**
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    /**
     * @return int
     */
    public function getChangeDate()
    {
        return $this->changeDate;
    }

    /**
     * @param int $changeDate
     */
    public function setChangeDate($changeDate)
    {
        $this->changeDate = $changeDate;
    }

    /**
     * @return bool
     */
    public function getDisabled()
    {
        return $this->disabled;
    }

    /**
     * @param bool $disabled
     */
    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;
    }

    /**
     * @return string
     */
    public function getOrderName()
    {
        return $this->orderName;
    }

    /**
     * @param string $orderName
     */
    public function setOrderName($orderName)
    {
        $this->orderName = $orderName;
    }

    /**
     * @return bool
     */
    public function getAuth()
    {
        return $this->auth;
    }

    /**
     * @param bool $auth
     */
    public function setAuth($auth)
    {
        $this->auth = $auth;
    }

}
