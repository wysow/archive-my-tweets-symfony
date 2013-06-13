<?php

namespace Wysow\ArchiveMyTweetsBundle\Extension;

use \Twig_Extension;
use \Twig_Filter_Method;

class Gravatar extends Twig_Extension
{
    public function getFilters()
    {
        return array(
            'getGravatarImage'    => new Twig_Filter_Method($this, 'getGravatarImage'),
        );
    }

    // get gravatar image
    public function getGravatarImage($email, $size = 80, $defaultImage = '', $rating = 'G')
    {
        return  $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $defaultImage ) . "&s=" . $size . '&r=' . $rating;
    }

    // for a service we need a name
    public function getName()
    {
        return 'gravatar';
    }

}
