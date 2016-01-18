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

use Cosma\Bundle\TestingBundle\TestCase\ElasticTestCase;
use Elastica\Document;
use Elastica\Request;

class ElasticTestCaseTest extends ElasticTestCase
{
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

    public function teastGetElasticClient()
    {
        $this->assertInstanceOf('Elastic\Client', $this->getElasticClient());
    }

    public function teastGetElasticIndex()
    {
        $this->assertInstanceOf('Elastic\Index', $this->getElasticIndex());
    }

    public function testElasticFirst()
    {
        $anotherElasticIndex = $this->getElasticClient()->getIndex('another_index');
        $anotherElasticIndex->create([], true);

        $type = $this->getElasticIndex()->getType('type');

        $type->addDocument(
            new Document(1, ['username' => 'someUser'])
        );

        $type->addDocument(
            new Document(2, ['username' => 'anotherUser'])
        );

        $type->addDocument(
            new Document(3, ['username' => 'someotherUser'])
        );

        $this->getElasticIndex()->refresh();

        $query = [
            'query' => [
                'query_string' => [
                    'query' => '*User',
                ]
            ]
        ];

        $path = $this->getElasticIndex()->getName() . '/' . $type->getName() . '/_search';

        $response = $this->getElasticClient()->request($path, Request::GET, $query);

        $responseArray = $response->getData();

        $this->assertEquals(3, $responseArray['hits']['total']);
    }

    public function testElasticSecond()
    {

        $type = $this->getElasticIndex()->getType('type');

        $type->addDocument(
            new Document(1, ['username' => 'cosmaUser'])
        );

        $this->getElasticIndex()->refresh();

        $query = [
            'query' => [
                'query_string' => [
                    'query' => '*User',
                ]
            ]
        ];

        $path = $this->getElasticIndex()->getName() . '/' . $type->getName() . '/_search';

        $response = $this->getElasticClient()->request($path, Request::GET, $query);

        $responseArray = $response->getData();

        $this->assertEquals(1, $responseArray['hits']['total']);
    }
}