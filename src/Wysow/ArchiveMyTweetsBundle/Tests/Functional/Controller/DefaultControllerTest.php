<?php

namespace Wysow\ArchiveMyTweetsBundle\Tests\Functional\Controller;

use Wysow\ArchiveMyTweetsBundle\Tests\Functional\BaseTestCase;

/**
 * @group archive-my-tweets
 */
class DefaultControllerTest extends BaseTestCase
{

    public function testIndexAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertTrue($crawler->filter('html:contains("Recent Tweets")')->count() > 0);
    }

    public function testFavoritesAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/favorites');

        $this->assertTrue($crawler->filter('html:contains("Favorite Tweets")')->count() > 0);
    }

    public function testArchiveAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/archive/2011/1');

        $this->assertTrue($crawler->filter('html:contains("January 2011")')->count() > 0);
    }

    public function testClientAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/client/TweetDeck');

        $this->assertTrue($crawler->filter('html:contains("Tweets from TweetDeck")')->count() > 0);
    }
}
