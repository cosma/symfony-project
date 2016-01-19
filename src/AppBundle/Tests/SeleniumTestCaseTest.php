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

namespace AppBundle\Tests;

use Cosma\Bundle\TestingBundle\TestCase\SeleniumTestCase;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class SeleniumTestCaseTest extends SeleniumTestCase
{

    protected function setUp()
    {
        parent::setUp();

    }


//    public function testGetKernel()
//    {
//        $kernel = $this->getKernel();
//        $this->assertInstanceOf('\Symfony\Component\HttpKernel\KernelInterface', $kernel);
//    }
//
//    public function testGetContainer()
//    {
//        $container = $this->getContainer();
//        $this->assertInstanceOf('\Symfony\Component\DependencyInjection\ContainerInterface', $container);
//    }
//
//    public function testGetClient()
//    {
//        $client = $this->getClient();
//        $this->assertInstanceOf('\Symfony\Bundle\FrameworkBundle\Client', $client);
//    }
//
//    public function testGetEntityWithId()
//    {
//        /** @type \AppBundle\Entity\Book $book */
//        $book = $this->getEntityWithId('\AppBundle\Entity\Book', 3);
//
//        $this->assertInstanceOf('\AppBundle\Entity\Book', $book);
//
//        $this->assertEquals(3, $book->getId());
//    }
//
//    public function testGetMockedEntityWithId()
//    {
//        /** @type \AppBundle\Entity\Book $book */
//        $book = $this->getMockedEntityWithId('\AppBundle\Entity\Book', 3);
//
//        $this->assertInstanceOf('\AppBundle\Entity\Book', $book);
//
//        $this->assertEquals(3, $book->getId());
//    }
//
//    public function testGetMockedEntityWithId_ShortName()
//    {
//        /** @type \AppBundle\Entity\Book $book */
//        $book = $this->getMockedEntityWithId('AppBundle:Book', 35);
//
//        $this->assertInstanceOf('\AppBundle\Entity\Book', $book);
//
//        $this->assertEquals(35, $book->getId());
//    }

    public function testSeleniumCosma()
    {
        $remoteWebDriver = $this->open('/cosma');

        $remoteWebDriver->wait(5)->until(
            WebDriverExpectedCondition::textToBePresentInElement(
                WebDriverBy::cssSelector('h1'),
                'Cosma'
            ),
            'page needs to contain this element'
        )
        ;


    }

    public function testSelenium()
    {
        $remoteWebDriver = $this->open('/');
        $title = $remoteWebDriver->getTitle();

        $this->assertEquals('Welcome!', $title, 'page is not loaded');
    }
}