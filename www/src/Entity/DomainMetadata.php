<?php

namespace Devzone\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;

/**
 * Class DomainMetadata
 * @package Devzone\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(
 *     name="domainmetadata",
 *     indexes={
 *      @Index(columns={"domain_id", "kind"})
 *     }
 * )
 */
class DomainMetadata
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Devzone\Entity\Domain")
     */
    private $domain;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $kind;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

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
     * @return \Devzone\Entity\DomainMetadata
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param \Devzone\Entity\DomainMetadata $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * @return string
     */
    public function getKind()
    {
        return $this->kind;
    }

    /**
     * @param string $kind
     */
    public function setKind($kind)
    {
        $this->kind = $kind;
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

}
