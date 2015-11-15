<?php
namespace AppBundle\Tests\Service;

use AppBundle\Entity\World;
use AppBundle\Service\HelloWorldService;
use Cosma\Bundle\TestingBundle\TestCase\SimpleTestCase;

class HelloWorldServiceTest extends SimpleTestCase
{

    /**
     * @see HelloWorldService::removeWorld
     */
    public function testRemoveWorld_Sucess()
    {
        $world = new World();

        $objectManager = $this->getMockForAbstractClass(
            'Doctrine\Common\Persistence\ObjectManager',
            [],
            '',
            false,
            true,
            true,
            ['remove', 'flush']
        );

        $objectManager->expects($this->any())
                      ->method('remove')
                      ->will($this->returnValue(true))
        ;
        $objectManager->expects($this->any())
                      ->method('flush')
                      ->will($this->returnValue(true))
        ;

        $logger = $this->getMock(
            'Symfony\Bridge\Monolog\Logger',
            ['info'],
            [],
            '',
            false
        );

        /** @type HelloWorldService $helloWorldService */
        $helloWorldService = new HelloWorldService($objectManager, $logger);

        $helloWorldService->removeWorld($world);
    }

    /**
     * @see HelloWorldService::sayHello
     */
    public function testSayHello_Sucess()
    {
        $objectManager = $this->getMockForAbstractClass('Doctrine\Common\Persistence\ObjectManager');

        $logger = $this->getMock(
            'Symfony\Bridge\Monolog\Logger',
            ['info'],
            [],
            '',
            false
        );

        $logger->expects($this->any())
        ->method('info')
        ->will($this->returnValue(true));

        /** @type HelloWorldService $helloWorldService */
        $helloWorldService = new HelloWorldService($objectManager, $logger);
        $hello = $helloWorldService->sayHello();

        $this->assertEquals('Hello World', $hello);

    }

    /**
     * @see HelloWorldService::sayHelloToWorld
     */
    public function testSayHelloToWorld_Sucess()
    {
        $objectManager = $this->getMockForAbstractClass('Doctrine\Common\Persistence\ObjectManager');

        $logger = $this->getMock(
            'Symfony\Bridge\Monolog\Logger',
            ['info'],
            [],
            '',
            false
        );

        $logger->expects($this->any())
               ->method('info')
               ->will($this->returnValue(true));

        /** @type HelloWorldService $helloWorldService */
        $helloWorldService = new HelloWorldService($objectManager, $logger);

        $world = new World();
        $world->setName('Terra');

        $hello = $helloWorldService->sayHelloToWorld($world);

        $this->assertEquals('Hello World, Terra', $hello);

    }
    
}