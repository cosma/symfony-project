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

    public function testGetEntityWithId(){
        /** @type \AppBundle\Entity\Book $book */
        $book = $this->getEntityWithId('\AppBundle\Entity\Book', 3);

        $this->assertInstanceOf('\AppBundle\Entity\Book', $book);

        $this->assertEquals(3, $book->getId());
    }

    public function testGetMockedEntityWithId(){
        /** @type \AppBundle\Entity\Book $book */
        $book = $this->getMockedEntityWithId('\AppBundle\Entity\Book', 3);

        $this->assertInstanceOf('\AppBundle\Entity\Book', $book);

        $this->assertEquals(3, $book->getId());
    }

    public function testGetTestClassPath(){

        $testClass = $this->getTestClassPath();

        $this->assertEquals('AppBundle/Tests/SimpleTestCaseTest', $testClass);

    }
    
}