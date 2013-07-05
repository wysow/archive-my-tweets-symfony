<?php

namespace Wysow\ArchiveMyTweetsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\Common\Annotations\AnnotationRegistry;

class DefaultControllerTest extends WebTestCase
{
    public function setUp()
    {
        /** To make annotations work here */
        AnnotationRegistry::registerAutoloadNamespaces(array('Sensio\\Bundle\\FrameworkExtraBundle' => __DIR__ . '/../../vendor/sensio/framework-extra-bundle/'));
        AnnotationRegistry::registerAutoloadNamespaces(array('Doctrine\\ORM\\Mapping' => __DIR__ . '/../../vendor/doctrine/orm/lib/'));
    }

    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertTrue($crawler->filter('html:contains("Recent Tweets")')->count() > 0);
    }
}
