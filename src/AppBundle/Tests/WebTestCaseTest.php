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

use Cosma\Bundle\TestingBundle\TestCase\WebTestCase;

class WebTestCaseTest extends WebTestCase
{
    public function testContainer(){
        $container = $this->getClient()->getContainer();
        $this->assertInstanceOf('\Symfony\Component\DependencyInjection\ContainerInterface', $container);
    }

    public function testKernelService(){
        $kernel = $this->getClient()->getContainer()->get("kernel");
        $this->assertInstanceOf('\Symfony\Component\HttpKernel\KernelInterface', $kernel);
    }

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

    public function testSomething(){
        $client = $this->getClient();
        $this->assertInstanceOf('\Symfony\Bundle\FrameworkBundle\Client', $client);
    }
}