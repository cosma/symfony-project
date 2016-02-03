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

use Cosma\Bundle\TestingBundle\TestCase\RedisTestCase;

class RedisTestCaseTest extends RedisTestCase
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

    public function teastGetRedisClient()
    {
        $this->assertInstanceOf('Predis\Client', $this->getRedisClient());
    }

    public function testRedisFirst()
    {
        $this->getRedisClient()->set('someHash', 'someValue');

        $this->assertEquals('someValue', $this->getRedisClient()->get('someHash'));
    }

    public function testRedisSecond()
    {
        $this->getRedisClient()->set('someOtherHash', 'someOtherValue');

        $this->assertEquals('someOtherValue', $this->getRedisClient()->get('someOtherHash'));

        $this->assertNull($this->getRedisClient()->get('someHash'));
    }
}