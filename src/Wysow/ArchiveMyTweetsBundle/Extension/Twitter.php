<?php

namespace Wysow\ArchiveMyTweetsBundle\Extension;

use \Twig_Extension;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Twitter extends Twig_Extension
{
    private $username, $name;

    public function __construct($username, $name)
    {
        $this->username = $username;
        $this->name = $name;
    }

   public function getGlobals()
   {
        $globals = array();

        $globals['twitter']['username'] = $this->username;
        $globals['twitter']['name'] = $this->name;

        return $globals;
   }

    // for a service we need a name
    public function getName()
    {
        return 'twitter';
    }

}
