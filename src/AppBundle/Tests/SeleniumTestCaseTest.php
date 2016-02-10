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
    public function setUp()
    {
        parent::setUp();

        $this->loadTableFixtures(
            ['Book', 'Author']
        );
    }

    public function testGetClient()
    {
        $client = $this->getClient();
        $this->assertInstanceOf('\Symfony\Bundle\FrameworkBundle\Client', $client);
    }

    public function testGetEntityWithId()
    {
        /** @type \AppBundle\Entity\Book $book */
        $book = $this->getEntityWithId('\AppBundle\Entity\Book', 3);

        $this->assertInstanceOf('\AppBundle\Entity\Book', $book);

        $this->assertEquals(3, $book->getId());
    }

    public function testGetMockedEntityWithId()
    {
        /** @type \AppBundle\Entity\Book $book */
        $book = $this->getMockedEntityWithId('\AppBundle\Entity\Book', 3);

        $this->assertInstanceOf('\AppBundle\Entity\Book', $book);

        $this->assertEquals(3, $book->getId());
    }

    public function testGetMockedEntityWithId_ShortName()
    {
        /** @type \AppBundle\Entity\Book $book */
        $book = $this->getMockedEntityWithId('AppBundle:Book', 35);

        $this->assertInstanceOf('\AppBundle\Entity\Book', $book);

        $this->assertEquals(35, $book->getId());
    }

    public function testLoadFixtures()
    {
        $bookRepository = $this->getEntityRepository('AppBundle:Book');
        $authorRepository = $this->getEntityRepository('AppBundle:Author');

        $this->loadFixtures(['src/AppBundle/Fixture/Table/Book.yml'], false);

        $this->loadCustomFixtures(['Fixture/Table/Book'], false);

        $this->assertCount(15, $bookRepository->findAll());

        $this->assertCount(3, $authorRepository->findAll());
    }

    /**
     * @retry 3
     */
    public function testSelenium_One()
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

    /**
     * @retry 3
     */
    public function testSelenium_Two()
    {
        $remoteWebDriver = $this->open('/');
        $title = $remoteWebDriver->getTitle();

        $this->assertEquals('Welcome!', $title, 'page is not loaded');
    }
}