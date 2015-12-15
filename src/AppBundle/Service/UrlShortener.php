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
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class UrlShortener
{

    /**
     * @type string
     */
    private $domain;

    /**
     * @type Router
     */
    private $router;

    public function __construct($domain, $router)
    {
        $this->domain = $domain;
        $this->router = $router;
    }

    /**
     * @param \AppBundle\Entity\Url $url
     *
     * @return \AppBundle\Entity\Url
     */
    public function short(Url $url)
    {
        $hash = $this->generateHash($url->getOriginalUrl());

        $shortURL = $this->router->generate(
            'redirect_url',
            [
                'url' => $hash
            ]
        );

        $url->setShortenUrl($this->domain . $shortURL);

        return $url;
    }

    private function generateHash($string){
        return hash('md5', $string);
    }
    
}