<?php

namespace Devzone\Enum;

use Greg0ire\Enum\AbstractEnum;

/**
 * Class DomainTypesEnum
 * @package Devzone\Enum
 */
abstract class DomainTypesEnum extends AbstractEnum
{

    const TYPE_MASTER = 'master';
    const TYPE_SLAVE = 'slave';
    const TYPE_NATIVE = 'native';

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

}
