<?php

namespace Devzone\Tests\Service\Domain;

use Devzone\Entity\Domain;
use Devzone\Service\Domain\NotifiedSerialGenerator;
use PHPUnit\Framework\TestCase;

/**
 * Class NotifiedSerialGeneratorTest
 * @package Devzone\Tests\Service\Domain
 */
class NotifiedSerialGeneratorTest extends TestCase
{

    public function testCreateNewGeneratorInstance(): void
    {
        $generator = new NotifiedSerialGenerator();

        $this->assertInstanceOf(NotifiedSerialGenerator::class, $generator);
    }

    public function testGenerateNumberForNewDomain(): void
    {
        $generator = new NotifiedSerialGenerator();
        $domain = new Domain();
        $currentDateFormat = date('Ymd');
        $expected = intval(sprintf('%s01', $currentDateFormat));

        $this->assertEquals($expected, $generator->generate($domain));
    }

    public function testIncrementNumberForExistingDomain(): void
    {
        $generator = new NotifiedSerialGenerator();
        $currentDateFormat = date('Ymd');
        $number = intval(sprintf('%s01', $currentDateFormat));

        $domain = new Domain();
        $domain->setNotifiedSerial($number);

        $expected = intval(sprintf('%s02', $currentDateFormat));

        $this->assertEquals($expected, $generator->generate($domain));
    }

    public function testGenerateNewNumberForExistingDomain(): void
    {
        $generator = new NotifiedSerialGenerator();
        $currentDateFormat = date('Ymd');
        $number = intval(2018010501);

        $domain = new Domain();
        $domain->setNotifiedSerial($number);

        $expected = intval(sprintf('%s01', $currentDateFormat));

        $this->assertEquals($expected, $generator->generate($domain));
    }

    public function testWrongIncrementalForExistingDomain(): void
    {
        $generator = new NotifiedSerialGenerator();
        $currentDateFormat = date('Ymd');
        $number = intval(sprintf('%s05', $currentDateFormat));

        $domain = new Domain();
        $domain->setNotifiedSerial($number);

        $expectedToPass = intval(sprintf('%s06', $currentDateFormat));
        $expectedToFail = intval(sprintf('%s07', $currentDateFormat));

        $generatedNumber = $generator->generate($domain);

        $this->assertEquals($expectedToPass, $generatedNumber);
        $this->assertNotEquals($expectedToFail, $generatedNumber);
    }

}
