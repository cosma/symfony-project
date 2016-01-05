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

use AppBundle\TestCase\SolrDBTestCase;

class SolrDBTestCaseTest extends SolrDBTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->loadFixtures(['AppBundle:Table:Book']);
    }

    public function testGetKernel()
    {
        $kernel = $this->getKernel();
        $this->assertInstanceOf('\Symfony\Component\HttpKernel\KernelInterface', $kernel);
    }

    public function testGetContainer()
    {
        $container = $this->getContainer();
        $this->assertInstanceOf('\Symfony\Component\DependencyInjection\ContainerInterface', $container);
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

    public function testSolr()
    {
        $solariumClient = $this->getSolariumClient();

        /**
         * get an update query instance
         */
        $update = $solariumClient->createUpdate();

        /**
         * first fixture document
         */
        $documentOne = $update->createDocument();
        $documentOne->id = 123;
        $documentOne->name = 'testdoc-1';
        $documentOne->price = 364;

        /**
         * second fixture document
         */
        $documentTwo = $update->createDocument();
        $documentTwo->id = 124;
        $documentTwo->name = 'testdoc-2';
        $documentTwo->price = 340;

        /**
         * add the documents and a commit command to the update query
         */
        $update->addDocuments([$documentOne, $documentTwo]);
        $update->addCommit();

        /**
         * execute query
         */
        $solariumClient->update($update);
    }




}