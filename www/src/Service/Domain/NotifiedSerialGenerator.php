<?php

namespace Devzone\Service\Domain;

use Devzone\Entity\Domain;
use Devzone\Service\Contract\Domain\NotifiedSerialInterface;

/**
 * Class NotifiedSerialGenerator
 * @package Devzone\Service\Domain
 */
class NotifiedSerialGenerator implements NotifiedSerialInterface
{

    /**
     * {@inheritdoc}
     */
    public function generate(Domain $entity): int
    {
        return (is_null($entity->getNotifiedSerial()))
            ? $this->createNumber()
            : $this->updateNumber($entity);
    }

    /**
     * @return int
     */
    private function createNumber(): int
    {
        return intval(
            sprintf('%s01', date('Ymd'))
        );
    }

    /**
     * @param Domain $entity
     *
     * @return int
     */
    private function updateNumber(Domain $entity): int
    {
        $currentDateFormat = date('Ymd');
        $serialNumberDateFormat = substr($entity->getNotifiedSerial(), 0, 8);
        $serialNumberIncremental = substr($entity->getNotifiedSerial(), -2);

        if ($currentDateFormat === $serialNumberDateFormat) {
            return intval(
                sprintf('%s%s', $serialNumberDateFormat, $this->calculateIncrementalValue($serialNumberIncremental))
            );
        }

        return $this->createNumber();
    }

    /**
     * @param string $currentValue
     *
     * @return string
     */
    private function calculateIncrementalValue(string $currentValue): string
    {
        return str_pad(
            intval($currentValue) + 1,
            strlen($currentValue),
            '0',
            STR_PAD_LEFT
        );
    }

}
