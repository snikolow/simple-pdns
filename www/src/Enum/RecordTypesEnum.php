<?php

namespace Devzone\Enum;

use Greg0ire\Enum\AbstractEnum;

/**
 * Class RecordTypesEnum
 * @package Devzone\Enum
 */
abstract class RecordTypesEnum extends AbstractEnum
{

    const TYPE_A = 'A';
    const TYPE_AAAA = 'AAAA';
    const TYPE_AFSDB = 'AFSDB';
    const TYPE_APL = 'APL';
    const TYPE_CAA = 'CAA';
    const TYPE_CDNSKEY = 'CDNSKEY';
    const TYPE_CDS = 'CDS';
    const TYPE_CERT = 'CERT';
    const TYPE_CNAME = 'CNAME';
    const TYPE_DHCID = 'DHCID';
    const TYPE_DLV = 'DLV';
    const TYPE_DNAME = 'DNAME';
    const TYPE_DNSKEY = 'DNSKEY';
    const TYPE_DS = 'DS';
    const TYPE_HIP = 'HIP';
    const TYPE_IPSECKEY = 'IPSECKEY';
    const TYPE_KEY = 'KEY';
    const TYPE_KX = 'KX';
    const TYPE_LOC = 'LOC';
    const TYPE_MX = 'MX';
    const TYPE_NAPTR = 'NAPTR';
    const TYPE_NS = 'NS';
    const TYPE_NSEC = 'NSEC';
    const TYPE_NSEC3 = 'NSEC3';
    const TYPE_NSEC3PARAM = 'NSEC3PARAM';
    const TYPE_OPENPGPKEY = 'OPENPGPKEY';
    const TYPE_PTR = 'PTR';
    const TYPE_RRSIG = 'RRSIG';
    const TYPE_RP = 'RP';
    const TYPE_SIG = 'SIG';
    const TYPE_SMIMEA = 'SMIMEA';
    const TYPE_SOA = 'SOA';
    const TYPE_SRV = 'SRV';
    const TYPE_SSHFP = 'SSHFP';
    const TYPE_TA = 'TA';
    const TYPE_TKEY = 'TKEY';
    const TYPE_TLSA = 'TLSA';
    const TYPE_TSIG = 'TSIG';
    const TYPE_TXT = 'TXT';
    const TYPE_URI = 'URI';

    /**
     * @return array
     */
    public static function getOptions(): array
    {
        return array_combine(
            array_values(static::getConstants()),
            array_values(static::getConstants())
        );
    }

    /**
     * @return array
     */
    public static function getOptionsForRecord(): array
    {
        return [
            self::TYPE_A => self::TYPE_A,
            self::TYPE_AAAA => self::TYPE_AAAA,
            self::TYPE_CNAME => self::TYPE_CNAME,
        ];
    }

}
