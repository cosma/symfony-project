<?php

/**
 * This file is part of the symfony-project project
 *
 * (c) Cosmin Voicu<cosmin.voicu@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 23/10/15
 * Time: 08:11
 */
class WebTestCase extends \Cosma\Bundle\TestingBundle\TestCase\WebTestCase
{

    public function testSomething(){
        $client = $this->getClient();

    }
    
}