<?php

namespace Wysow\ArchiveMyTweetsBundle\Tests\Functional;

use Symfony\Component\Filesystem\Filesystem;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BaseTestCase extends WebTestCase
{
    static protected function createKernel(array $options = array())
    {
        return self::$kernel = new AppKernel(
            isset($options['config']) ? $options['config'] : 'default.yml'
        );
    }

    protected function setUp()
    {
        $fs = new Filesystem();
        $fs->remove(sys_get_temp_dir().'/WysowArchiveMyTweetsBundle/');
    }
}