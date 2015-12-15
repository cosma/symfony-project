<?php
/**
 * This file is part of the symfony-project project.
 *
 * @project    symfony-project
 * @author     Cosmin Voicu <cosmin.voicu@oconotech.com>
 * @copyright  2015 - ocono Tech GmbH
 * @license    http://www.ocono-tech.com proprietary
 * @link       http://www.ocono-tech.com
 * @date       15/12/15
 */

namespace AppBundle\Service;

use AppBundle\Entity\Url;

class UrlShortener
{

    /**
     * @param \AppBundle\Entity\Url $url
     *
     * @return \AppBundle\Entity\Url
     */
    public function short(Url $url)
    {
        return $url;
    }
    
}