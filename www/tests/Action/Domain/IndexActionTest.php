<?php

namespace Devzone\Tests\Action\Domain;

use Devzone\Tests\Action\AbstractBaseAction;

/**
 * Class IndexActionTest
 * @package Devzone\Tests\Action\Domain
 */
class IndexActionTest extends AbstractBaseAction
{

    public function testLogInAndOpenDomainListingPage()
    {
        $this->logInUserWithBasicAuth();

        $client = $this->getClient();
        $client->followRedirects();
        $client->request('GET', '/domains');

        $this->assertSame('Domains', $client->getCrawler()->filter('h4.page-title')->text());
    }

}
