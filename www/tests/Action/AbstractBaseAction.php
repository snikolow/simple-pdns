<?php

namespace Devzone\Tests\Action;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

/**
 * Class AbstractBaseAction
 * @package Devzone\Tests\Action
 */
abstract class AbstractBaseAction extends WebTestCase
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * Base method to reuse for Action tests.
     *
     * Provides an easy way to use In-Memory provider to authenticate a user.
     *
     * @param string $username
     * @param string $password
     *
     * @return void
     */
    protected function logInUserWithBasicAuth($username = 'test@example.me', $password = 'test')
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => $username,
            'PHP_AUTH_PW'   => $password,
        ]);

        $session = $client->getContainer()->get('session');
        $firewall = 'main';
        $token = new UsernamePasswordToken('test@example.me', null, $firewall, ['ROLE_USER']);

        $session->set('_security_' . $firewall, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $client->getCookieJar()->set($cookie);

        $this->client = $client;
    }

    /**
     * @return Client
     */
    protected function getClient(): Client
    {
        return $this->client;
    }

}
