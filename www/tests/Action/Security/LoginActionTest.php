<?php

namespace Devzone\Tests\Action\Security;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class LoginActionTest
 * @package Devzone\Tests\Action\Security
 */
class LoginActionTest extends WebTestCase
{

    public function testOpenLoginPageSuccessfully()
    {
        $client = static::createClient();
        $client->request('GET','/login');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('<h3 class="card-title">Authentication</h3>', $client->getResponse()->getContent());
    }

    public function testRedirectRestrictedPageToLogin()
    {
        $client = static::createClient();
        $client->request('GET', '/domains');

        /** @var Crawler $crawler */
        $crawler = $client->followRedirect();

        $this->assertSame('Authentication', $crawler->filter('h3.card-title')->text());
    }

}
