<?php

/**
 * This file is part of the symfony-project project.
 *
 * @project    symfony-project
 * @author     Cosmin Voicu <cosmin.voicu@oconotech.com>
 * @copyright  2015 - ocono Tech GmbH
 * @license    http://www.ocono-tech.com proprietary
 * @link       http://www.ocono-tech.com
 * @date       22/10/15
 */
class SimpleTestCaseTest extends \Cosma\Bundle\TestingBundle\TestCase\SimpleTestCase
{

    public function testSomething(){
        $this->getEntityWithId('Asd');

    }
    
}