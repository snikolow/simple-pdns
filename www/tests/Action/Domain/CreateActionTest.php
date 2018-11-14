<?php

namespace Devzone\Tests\Action\Domain;

use Devzone\Tests\Action\AbstractBaseAction;

/**
 * Class CreateActionTest
 * @package Devzone\Tests\Action\Domain
 */
class CreateActionTest extends AbstractBaseAction
{

    public function testClickAddMasterDomainAndAssertFormLoaded()
    {
        $this->logInUserWithBasicAuth();

        $client = $this->getClient();
        $client->followRedirects();
        $client->request('GET', '/domains');

        $this->assertSame('Domains', $client->getCrawler()->filter('h4.page-title')->text());

        $button = $client->getCrawler()
            ->filter('a:contains("Add Master")')
            ->eq(0)
            ->link();

        $client->click($button);

        $this->assertSame('Manage domain', $client->getCrawler()->filter('h4.page-title')->text());
        $this->assertTrue($client->getCrawler()->filter('form[name="domain"]')->count() > 0);
    }

}
