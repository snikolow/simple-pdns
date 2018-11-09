<?php

namespace Devzone\Entity\Traits;

/**
 * Trait DomainExtraTrait
 * @package Devzone\Entity\Traits
 */
trait DomainExtraTrait
{

    // Non-mapped columns used in the DomainType form, in order
    // to create the first default Record, once a Domain is added.

    /**
     * @var string
     */
    public $primary;

    /**
     * @var int
     */
    public $refresh = 3600;

    /**
     * @var int
     */
    public $expire = 604800;

    /**
     * @var int
     */
    public $retry = 900;

    /**
     * @var
     */
    public $ttl = 86400;

    /**
     * @var string
     */
    public $email;

    /**
     * @return string
     */
    public function getPrimary()
    {
        return $this->primary;
    }

    /**
     * @param string $primary
     */
    public function setPrimary(string $primary)
    {
        $this->primary = $primary;
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
