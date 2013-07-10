<?php

namespace Wysow\ArchiveMyTweetsBundle\Tests\Functional\Controller;

use Wysow\ArchiveMyTweetsBundle\Tests\Functional\BaseTestCase;

/**
 * @group archive-my-tweets
 */
class DefaultControllerTest extends BaseTestCase
{

    public function testIndex()
    {
        $client = static::createClient();
        $this->importDatabaseSchema();

        $crawler = $client->request('GET', '/');

        $this->assertTrue($crawler->filter('html:contains("Recent Tweets")')->count() > 0);
    }
}
