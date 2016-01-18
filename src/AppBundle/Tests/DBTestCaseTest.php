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

use Cosma\Bundle\TestingBundle\TestCase\DBTestCase;

class DBTestCaseTest extends DBTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->dropDatabase();
    }

    public function testKernel()
    {
        $kernel = $this->getKernel();
        $this->assertInstanceOf('\Symfony\Component\HttpKernel\KernelInterface', $kernel);
    }

    public function testContainer()
    {
        $container = $this->getContainer();
        $this->assertInstanceOf('\Symfony\Component\DependencyInjection\ContainerInterface', $container);
    }

    public function testClient()
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

    public function testGetEntityManager()
    {
        $entityManager = $this->getEntityManager();
        $this->assertInstanceOf('\Doctrine\ORM\EntityManager', $entityManager);
    }

    public function testGetEntityRepository()
    {
        $entityRepository = $this->getEntityRepository('AppBundle:Book');
        $this->assertInstanceOf('\Doctrine\ORM\EntityRepository', $entityRepository);
    }

    public function testLoadFixtures()
    {
        $bookRepository = $this->getKernel()->getContainer()->get('doctrine')->getRepository('AppBundle:Book');

        $this->assertEmpty($bookRepository->findAll());

        $fixtures = $this->loadFixtures(['AppBundle:Table:Book']);

        $this->assertCount(5, $bookRepository->findAll());
    }
}